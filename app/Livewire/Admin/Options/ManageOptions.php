<?php

namespace App\Livewire\Admin\Options;

use App\Models\Option;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ManageOptions extends Component
{
    public $options;
    public $openModal = false;
    public $newOption = [
        'name' => '',
        'type' => 1,
        'features' => [
            [
                'value' => '',
                'description' => '',
            ]
        ],
    ];

    public function updatedNewOptionType($value)
    {
        foreach ($this->newOption['features'] as $key => $feature) {
            $this->newOption['features'][$key]['value'] = '';
        }
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
        $this->newOption['features'][] = [
            'value' => '',
            'description' => '',
        ];
    }

    public function removeFeature($index)
    {
        unset($this->newOption['features'][$index]);
        $this->newOption['features'] = array_values($this->newOption['features']);
    }

    public function addOption()
    {
        $rules = [
            'newOption.name' => 'required|max:255',
            'newOption.type' => 'required|in:1,2',
            'newOption.features' => 'required|array|min:1',
            // 'newOption.features.*.value' => 'required|max:255',
        ];
        foreach ($this->newOption['features'] as $key => $feature) {
            // $rules['newOption.features.'.$key.'.value'] = 'required|max:255';
            if ( $this->newOption['type'] == 1 )
            {
                $rules['newOption.features.'.$key.'.value'] = 'required|max:255';
            } else {
                $rules['newOption.features.'.$key.'.value'] = 'required|regex:/^#[a-f0-9]{6}$/i';
            }
            $rules['newOption.features.'.$key.'.description'] = 'required|max:255';
        }

        $this->validate($rules);

        $option = Option::create([
            'name' => $this->newOption['name'],
            'type' => $this->newOption['type'],
        ]);

        foreach ($this->newOption['features'] as $key => $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description'],
            ]);
        }

        $this->options = Option::with('features')->orderBy('id', 'desc')->get();

        $this->reset('newOption', 'openModal');

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Opción creada correctamente',
        ]);
    }
}
