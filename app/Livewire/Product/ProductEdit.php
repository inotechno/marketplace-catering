<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use LivewireAlert, WithFileUploads;
    public $product_images;
    public $product_id;
    public $product;
    public $images = [];
    public $category_id;
    public $name;
    public $description;
    public $price;
    public $merchant_id;
    public $categories = [];

    public function mount($id)
    {
        $this->product = Product::find($id);
        $this->product_id = $id;
        $this->categories = CategoryProduct::all();
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->merchant_id = $this->product->merchant_id;
        $this->category_id = $this->product->category_id;
        $this->product_images = $this->product->images;

        // dd($this->product_images);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'merchant_id' => 'required',
            'category_id' => 'required',
        ]);

        try {
            $this->product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'merchant_id' => $this->merchant_id,
                'category_id' => $this->category_id,
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
                    $this->product->images()->create([
                        'image_path' => $imagePath,
                        'image_url' => $imageUrl,
                    ]);
                }

                $this->product_images = $this->product->images;
            }

            $this->alert('success', 'Product updated successfully');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.product.product-edit')->layout('layouts.app', ['title' => 'Product Edit']);
    }
}
