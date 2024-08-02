<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductIndex extends Component
{
    use LivewireAlert;
    public $perPage = 10;
    public $productId;
    public $product;
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function confirmDelete($productId)
    {
        $this->productId = $productId;
        $this->product = Product::find($productId);

        $this->alert('warning', 'Are you sure you want to delete this product?', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showCancelButton' => true,
            'cancelButtonText' => 'No, Keep it',
            'confirmButtonText' => 'Yes, I am sure',
            'showConfirmButton' => true,
            'onConfirmed' => 'delete',
            'onCancelled' => 'cancelled',
        ]);
    }

    #[On('cancelled')]
    public function cancelled()
    {
        $this->alert('info', 'You have cancelled the process', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
        ]);
    }

    #[On('delete')]
    public function delete()
    {
        $this->product->delete();
        $this->alert('success', 'Product deleted successfully');
        return redirect()->route('product.index');
    }


    public function render()
    {
        $products = Product::when($this->search, function ($query) {
            return $query->where('name', 'like', '%' . $this->search . '%');
        })
            ->where('merchant_id', Auth::user()->merchant->id)
            ->paginate($this->perPage);

        return view('livewire.product.product-index', compact('products'))->layout('layouts.app', ['title' => 'Product']);
    }
}
