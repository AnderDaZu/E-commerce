<?php

namespace App\Livewire;

use App\Models\Option;
use Livewire\Component;

class Filter extends Component
{
    public $family_id;
    public $options;

    public function mount()
    {
        $this->options = Option::whereHas('products.subcategory.category', function ($query) {
            $query->where('family_id', $this->family_id);
        })
        ->with([
            'features' => function ($query) {
                $query->whereHas('variants.product.subcategory.category', function ($query) {
                    $query->where('family_id', $this->family_id);
                });
            }
        ])
        ->get();
    }

    public function render()
    {
        return view('livewire.filter');
    }
}
