<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class OrderIndex extends Component
{
    use LivewireAlert, WithFileUploads;
    public $perPage = 10;
    public $search = '';
    public $role = '';
    public $user = '';

    public $proff_file;
    public $order_id, $order;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->role = $this->user->roles->first()->name;
    }

    public function setOrder($order_id)
    {
        $this->order_id = $order_id;
        $this->order = Order::find($order_id);
    }

    public function confirmApprove($orderId)
    {
        $this->order_id = $orderId;
        $this->order = Order::find($orderId);

        $this->alert('question', 'Are you sure you want to approve this order?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'onConfirmed' => 'approve',
            'onCancelled' => 'cancelApprove',
            'confirmButtonText' => 'Yes',
            'cancelButtonText' => 'No',
        ]);
    }

    public function confirmDeliver($orderId)
    {
        $this->order_id = $orderId;
        $this->order = Order::find($orderId);

        $this->alert('question', 'Are you sure you want to deliver this order?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'onConfirmed' => 'deliver',
            'onCancelled' => 'cancelApprove',
            'confirmButtonText' => 'Yes',
            'cancelButtonText' => 'No',
        ]);
    }

    #[On('deliver')]
    public function deliver()
    {
        $this->order->update([
            'delivery_at' => now(),
            'status' => 'delivered',
        ]);

        $this->alert('success', 'Order delivered successfully');
        $this->order_id = null;
        $this->order = null;
    }

    #[On('cancelApprove')]
    public function cancelApprove()
    {
        $this->order_id = null;
        $this->order = null;
    }

    #[On('approve')]
    public function approve()
    {
        $this->order->update([
            'merchant_confirmation' => true,
            'status' => 'delivery',
        ]);

        $this->alert('success', 'Order approved successfully');
        $this->order_id = null;
        $this->order = null;
    }

    public function updatedProffFile()
    {
        // dd($this->order);
        $this->validate([
            'proff_file' => 'required|mimes:jpg,jpeg,png|max:2048',
            'order_id' => 'required',
        ]);

        try {
            $uid = Str::uuid();
            $file_path = $this->proff_file->storeAs('public/proofs', $uid . '.' . $this->proff_file->extension());
            $imageUrl = Storage::disk('public')->url($file_path);

            $this->order->update([
                'payment_at' => now(),
                'status' => 'waiting approval',
                'proff_file_path' => $file_path,
                'proff_file_url' => $imageUrl
            ]);

            $this->alert('success', 'Proof uploaded successfully');
            $this->reset(['proff_file', 'order_id']);

            $this->dispatch('$refresh');
        } catch (\Exception $e) {
            $this->alert('error', 'Something went wrong');
            $this->reset(['proff_file', 'order_id']);
        }
    }

    public function render()
    {
        $orders = Order::with('customer', 'merchant', 'paymentMethod', 'orderDetails', 'products')->when($this->search, function ($query) {
            $query->whereHas('customer', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

            $query->orWhereHas('merchant', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

            $query->orWhereHas('paymentMethod', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

            $query->orWhereHas('orderDetails', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

            $query->orWhereHas('products', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });

        })->latest();

        if (Auth::user()->hasRole('Administrator')) {
            $orders = $orders->paginate($this->perPage);
        } else if (Auth::user()->hasRole('Merchant')) {
            $orders = $orders->where('merchant_id', Auth::user()->merchant->id)->paginate($this->perPage);
        } else if (Auth::user()->hasRole('Customer')) {
            $orders = $orders->where('customer_id', Auth::user()->customer->id)->paginate($this->perPage);
        }

        return view('livewire.order.order-index', compact('orders'))->layout('layouts.app', ['title' => 'Order List']);
    }
}
