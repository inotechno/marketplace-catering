<?php

namespace App\Livewire\Catering;

use App\Models\Order;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Merchant;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class CateringProduct extends Component
{
    use LivewireAlert;

    public $merchant;
    public $merchant_id;
    public $product_id, $product;
    public $quantity;
    public $payment_method_id;

    public $perPage = 10;
    public $search = '';
    public $showModal = false;

    public $payment_methods;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount($merchant_id)
    {
        $this->merchant = Merchant::where('uid', $merchant_id)->firstOrFail();
        $this->merchant_id = $this->merchant->id;

        $this->payment_methods = PaymentMethod::all();
    }

    public function openModal($productId)
    {
        $this->product = Product::find($productId);
        $this->product_id = $productId;
        $this->showModal = true; // Show the modal
    }

    public function hideModal()
    {
        $this->showModal = false; // Hide the modal
    }

    public function order()
    {
        $this->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'payment_method_id' => 'required',
        ]);

        try {
            $order = Order::create([
                'order_id' => Str::uuid(),
                'customer_id' => Auth::user()->customer->id,
                'merchant_id' => $this->merchant_id,
                'payment_method_id' => $this->payment_method_id,
                'status' => 'pending',
                'ordered_at' => now(),
                'total_amount' => $this->quantity * $this->product->price,
            ]);

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $this->product_id,
                'quantity' => $this->quantity,
                'price' => $this->product->price,
                'total' => $this->quantity * $this->product->price,
            ]);

            $this->hideModal();
            $this->alert('success', 'Order created successfully');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function render()
    {
        $products = Product::when($this->search, function ($query) {
            return $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        })->where('merchant_id', $this->merchant_id)->paginate($this->perPage);

        return view('livewire.catering.catering-product', compact('products'))->layout('layouts.app', ['title' => 'Catering Product']);
    }
}
