<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads; // trait para permitir subir archivos

    public $product;
    public $productEdit;
    public $image;
    public $families;
    public $family_id;
    public $category_id;
    public $selectedSubCategory;

    protected $listeners = [ 'updateFieldStock' ];

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

    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->productEdit['subcategory_id'] = '';
    }
    public function updatedCategoryId($value)
    {
        $this->productEdit['subcategory_id'] = '';
    }

    public function mount($product)
    {
        $this->families = Family::all();
        $this->family_id = $product->subcategory->category->family->id;
        $this->category_id = $product->subcategory->category->id;
        $this->productEdit = $product->only('image_path', 'sku', 'name', 'description', 'subcategory_id', 'price', 'stock');
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
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
        return view('livewire.admin.products.product-edit');
    }

    #[On('variant-generate', 'feature-deleted', 'option-deleted')] // estar a la escucha de este evento (ProductVariant:generarVariantes)
    public function updateProduct()
    {
        $this->product = $this->product->fresh();
    }

    public function update()
    {
        $this->validate([
            'image' => 'nullable|image|max:1024',
            'productEdit.sku' => 'required|unique:products,sku,' .$this->product->id,
            'productEdit.name' => 'required|max:255',
            'productEdit.description' => 'nullable',
            'productEdit.price' => 'required|numeric|min:0',
            'productEdit.stock' => 'required|numeric|min:0',
            'productEdit.subcategory_id' => 'required|exists:subcategories,id',
            'family_id' => 'required',
            'category_id' => 'required',
        ], [], [
            'image' => 'Imagen del producto',
            'productEdit.sku' => 'Código de producto',
            'productEdit.name' => 'Nombre del producto',
            'productEdit.description' => 'Descripción del producto',
            'productEdit.price' => 'Precio del producto',
            'productEdit.stock' => 'Stock del producto',
            'productEdit.subcategory_id' => 'Subcategoría del producto',
            'family_id' => 'Familia del producto',
            'category_id' => 'Categoría del producto',
        ]);

        if ( $this->image ){

            Storage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products');

            // Eliminar imagen temporal
            if ( file_exists( $this->image->getRealPath() ) ) {
                unlink( $this->image->getRealPath() );
                $this->image = null;
            }
        }

        $this->product->update($this->productEdit);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Producto actualizado',
            'text' => 'El producto se ha actualizado correctamente',
        ]);

        return redirect()->route('admin.products.edit', $this->product);
    }
}
