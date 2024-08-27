<?php

namespace App\Livewire\Forms\Admin\Option;

use App\Models\Option;
use Livewire\Attributes\Validate;
use Livewire\Form;

class NewOptionForm extends Form
{
    public $openModal = false;
    public $name;
    public $type = 1;
    public $features = [
        [
            'value' => '',
            'description' => '',
        ]
    ];

    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'type' => 'required|in:1,2',
            'features' => 'required|array|min:1',
            // 'features.*.value' => 'required|max:255',
        ];

        foreach ($this->features as $key => $feature) {
            if ( $this->type == 1 )
            {
                $rules['features.'.$key.'.value'] = 'required|max:255';
            } else {
                $rules['features.'.$key.'.value'] = 'required|regex:/^#[a-f0-9]{6}$/i';
            }
            $rules['features.'.$key.'.description'] = 'required|max:255';
        }

        return $rules;
    }

    public function validationAttributes()
    {
        $attributes = [
            'name' => 'Nombre',
            'type' => 'Tipo',
            'features' => 'valor'
        ];

        foreach ($this->features as $index => $feature) {
            $attributes['features.' . $index . '.value'] = 'valor ' . ($index + 1);
            $attributes['features.' . $index . '.description'] = 'descripción ' . ($index + 1);
        }

        return $attributes;
    }

    public function addFeature()
    {
        $this->features[] = [
            'value' => '',
            'description' => '',
        ];
    }

    public function removeFeature($key)
    {
        unset($this->features[$key]);
        $this->features = array_values($this->features);
    }

    public function save()
    {
        $this->validate();

        $option = Option::create([
            'name' => $this->name,
            'type' => $this->type,
        ]);

        foreach ($this->features as $key => $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description'],
            ]);
        }

        $this->reset('name', 'type', 'features', 'openModal');
    }
}
