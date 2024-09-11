<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads; // trait para permitir subir archivos

    public $families;
    public $image;
    public $family_id = '';
    public $category_id = '';

    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'price' => '',
        'subcategory_id' => '',
        'image_path' => '',
    ];

    public function updatedFamilyId()
    {
        $this->category_id = '';
        $this->product['subcategory_id'] = '';
    }

    public function updatedCategoryId()
    {
        $this->product['subcategory_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }

    #[Computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    public function mount()
    {
        $this->families = Family::all();
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if( $validator->fails() )
            {
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'Debes completar los campos obligatorios (*)',
                ]);
            }
        });
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }

    public function store()
    {
        $this->validate([
            'image' => 'required|image|max:1024',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.description' => 'nullable',
            'product.subcategory_id' => 'required|exists:subcategories,id',
            'product.price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'family_id' => 'required|exists:families,id',
        ], [], [
            'product.sku' => 'Código',
            'product.name' => 'Nombre del producto',
            'product.description' => 'Descripción del producto',
            'product.subcategory_id' => 'Subcategoría del producto',
            'product.price' => 'Precio del producto',
            'category_id' => 'Categoría del producto',
            'family_id' => 'Familia del producto',
        ]);

        $this->product['image_path'] = $this->image->store('products');
        // Storage::delete()
        // dd($this->image->temporaryUrl());

        $product = Product::create($this->product);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Se agrego el producto: ' . $product->name,
        ]);

        return redirect()->route('admin.products.edit', $product);
    }
}
