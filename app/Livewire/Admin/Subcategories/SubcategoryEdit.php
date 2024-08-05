<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    public $families;
    public $subcategory;
    public $subcategoryEdit;

    public function mount( $subcategory )
    {
        $this->subcategoryEdit = [
            'name' => $subcategory->name,
            'category_id' => $subcategory->category_id,
            'family_id' => $subcategory->category->family_id,
        ];

        $this->families = Family::all();
    }

    public function updatedSubcategoryEditFamilyId()
    {
        $this->subcategoryEdit['category_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subcategoryEdit['family_id'])->get();
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }

    public function save()
    {
        $this->validate([
            'subcategoryEdit.name' => "required|unique:subcategories,name," . $this->subcategory->id,
            'subcategoryEdit.family_id' => 'required|exists:families,id',
            'subcategoryEdit.category_id' => 'required|exists:categories,id',
        ], [ ], [
            'subcategoryEdit.name' => 'Nombre',
            'subcategoryEdit.family_id' => 'Familia',
            'subcategoryEdit.category_id' => 'Categoría',
        ]);

        $this->subcategory->update($this->subcategoryEdit);

        // emitir evento
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Sucategoría se actualizó con éxito'
        ]);
    }
}
