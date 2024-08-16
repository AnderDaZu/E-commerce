<?php

namespace App\Livewire\Admin\Options;

use App\Livewire\Forms\Admin\Option\NewOptionForm;
use App\Models\Option;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ManageOptions extends Component
{
    public $options;
    public NewOptionForm $newOption;

    public function updatedNewOptionType($value)
    {
        foreach ($this->newOption->features as $key => $feature) {
            $this->newOption->features[$key]['value'] = '';
        }
    }   

    public function boot()
    {
        $this->newOption->withValidator(function ($validator) {
            if ($validator->fails()) {
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'Debes completar los campos obligatorios (*)',
                ]);
            }
        });
    }
    public function mount()
    {
        $this->options = Option::with('features')->orderBy('id', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }

    public function isDisabled($value, $description)
    {
        if( mb_strlen(trim($value)) == 0 || mb_strlen(trim($description)) == 0 )
        {
            return true;
        }
    }

    public function addFeature()
    {
        $this->newOption->addFeature();
    }

    public function removeFeature($index)
    {
        $this->newOption->removeFeature($index);
    }

    public function addOption()
    {
        $this->newOption->save();

        $this->options = Option::with('features')->orderBy('id', 'desc')->get();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Opción creada correctamente',
        ]);
    }
}
