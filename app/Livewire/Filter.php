<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;
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
        $products = Product::whereHas('subcategory.category', function ($query) {
            $query->where('family_id', $this->family_id);
        })
        ->paginate(12);
        return view('livewire.filter', compact('products'));
    }
}
