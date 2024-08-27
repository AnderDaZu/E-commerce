<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Navigation extends Component
{
    public $families;
    public $family_id;

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)
            ->with('subcategories')
            ->get();
    }
    #[Computed()]
    public function familyName()
    {
        return Family::find($this->family_id)->name;
    }

    public function mount()
    {
        $this->families = Family::all();
        $this->family_id = $this->families->first()->id;
    }
    public function render()
    {
        return view('livewire.navigation');
    }
}
