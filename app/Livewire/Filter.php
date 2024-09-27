<?php

namespace App\Livewire;

use Livewire\Component;

class Filter extends Component
{
    public $family_id;

    public function render()
    {
        return view('livewire.filter');
    }
}
