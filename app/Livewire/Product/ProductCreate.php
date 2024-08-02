<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use LivewireAlert, WithFileUploads;
    public $images = [];
    public $category_id;
    public $name;
    public $description;
    public $price;
    public $merchant_id;
    public $categories = [];

    public function mount()
    {
        $this->categories = CategoryProduct::all();
    }

    public function store()
    {
        // dd($this->images);
        $this->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        try {
            $product = Product::create([
                'uid' => Str::uuid(),
                'category_id' => $this->category_id,
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
                'price' => $this->price,
                'merchant_id' => Auth::user()->merchant->id,
            ]);

            if ($this->images) {
                // Loop through each image in $this->images
                foreach ($this->images as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $newFilename = Str::uuid() . '.' . $extension;
                    $imagePath = 'products/' . $newFilename;

                    // Pindahkan gambar ke direktori public
                    $file->storeAs('public/products', $newFilename);

                    // Dapatkan URL untuk gambar yang diunggah
                    $imageUrl = Storage::disk('public')->url($imagePath);

                    // Simpan informasi gambar ke database
                    $product->images()->create([
                        'image_path' => $imagePath,
                        'image_url' => $imageUrl,
                    ]);
                }
            }

            $this->alert('success', 'Product created successfully');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            $this->alert('error', $th->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.product.product-create')->layout('layouts.app', ['title' => 'Product Create']);
    }
}
