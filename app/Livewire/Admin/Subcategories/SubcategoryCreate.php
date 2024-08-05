<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryCreate extends Component
{
    public $families;
    public $subcategory = [
        'name' => '',
        'family_id' => '',
        'category_id' => '',
    ];

    public function mount()
    {
        $this->families = Family::all();
    }

    public function updatedSubcategoryFamilyId()
    {
        $this->subcategory['category_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subcategory['family_id'])->get();
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }

    public function save()
    {
        $this->validate([
            'subcategory.name' => 'required|unique:subcategories,name',
            'subcategory.family_id' => 'required|exists:families,id',
            'subcategory.category_id' => 'required|exists:categories,id',
        ], [
            // 'subcategory.name.required' => 'El nombre de la subcategoría es obligatorio',
            // 'subcategory.family_id.required' => 'La familia es obligatoria',
            // 'subcategory.category_id.required' => 'La categoría es obligatoria',
            // 'subcategory.family_id.exists' => 'La familia no existe',
            // 'subcategory.category_id.exists' => 'La categoría no existe',
        ], [
            'subcategory.name' => 'Nombre',
            'subcategory.family_id' => 'Familia',
            'subcategory.category_id' => 'Categoría',
        ]);

        $subcategory = Subcategory::create($this->subcategory);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Se creo la subcategoría: ' . $subcategory->name,
        ]);

        return redirect()->route('admin.subcategories.index');
    }
}
