<?php

namespace App\Livewire\Admin\Options;

use Livewire\Component;

class AddNewFeature extends Component
{
    public $option;
    public $newFeature = [
        'value' => '',
        'description' => '',
    ];

    public function isDisabled($value, $description)
    {
        if( mb_strlen(trim($value)) == 0 || mb_strlen(trim($description)) == 0 )
        {
            return true;
        }
    }

    public function mount()
    {
        $this->fieldType();
    }
    public function render()
    {
        return view('livewire.admin.options.add-new-feature');
    }

    public function addFeature()
    {
        $this->validate([
            'newFeature.value' => 'required',
            'newFeature.description' => 'required',
        ]);

        $this->option->features()->create([
            'value' => $this->newFeature['value'],
            'description' => $this->newFeature['description'],
        ]);

        $this->reset('newFeature');
        $this->fieldType();

        // se dispara este evento para que se actualice la lista de opciones en el componente padre
        $this->dispatch('featureAdded');

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Valor creado correctamente',
        ]);
    }

    public function fieldType()
    {
        if( $this->option->type == 2 )
        {
            $this->newFeature['value'] = '#000000';
        }
    }
}
