<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use App\Models\Product;
use App\Models\Variant;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductVariants extends Component
{
    public $product;
    public $openModal = false;
    public $options;
    public $optionsSelected;

    public $variant = [
        'option_id' => '',
        'features' => [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ]
        ],
    ];
    protected $listeners = ['refreshParentComponent' => 'refreshComponent'];

    public function updatedVariantOptionId($value)
    {
        $this->variant['features'] = [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ],
        ];

        if( $value )
        {
            $this->resetErrorBag('variant.option_id');
        }
    }

    public function updatedOpenModal()
    {
        $this->reset('variant');
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if( $validator->fails() )
            {
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'Debes completar los campos obligatorios (*)',
                ]);
            }
        });
    }

    #[Computed()]
    public function features()
    {
        return Feature::where('option_id', $this->variant['option_id'])
            ->get();
    }

    public function getOptions()
    {
        $options = $this->product->options->toArray();
        $this->optionsSelected = array_column($options, 'id') ?? [];
        $this->options = Option::whereNotIn('id', $this->optionsSelected)->get();
    }

    public function save()
    {
        $rules = $this->rules();
        $attributes = $this->validationAttributes();

        $this->validate($rules, [], $attributes);

        $this->product->options()->attach($this->variant['option_id'], [
            'features' => $this->variant['features']
        ]);

        $this->getOptions();

        $this->generarVariantes();

        $this->reset('variant', 'openModal');
        
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Opción agregada correctamente',
        ]);
    }

    public function rules()
    {
        $rules = [
            'variant.option_id' => 'required|exists:options,id',
            'variant.features' => 'required|array|min:1',
        ];

        foreach ($this->variant['features'] as $index => $feature) {
            $rules['variant.features.' . $index . '.id'] = 'required|exists:features,id';
        }

        return $rules;
    }

    public function validationAttributes()
    {
        $attributes = [
            'variant.option_id' => 'Opción',
            'variant.features' => 'Valor',
        ];

        foreach ($this->variant['features'] as $index => $feature) {
            $attributes['variant.features.' . $index . '.id'] = 'valor ' . ($index + 1);
        }

        return $attributes;
    }

    public function mount()
    {
        $this->getOptions();
    }
    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }

    public function generarVariantes()
    {
        $features = $this->product->options->pluck('pivot.features');
    
        $combinaciones = $this->generarCombinaciones($features);

        $this->product->variants()->delete();
    
        foreach ($combinaciones as $combinacion) {
            $variant = Variant::create([
                'product_id' => $this->product->id,
            ]);
            $variant->features()->attach($combinacion);
        }

        $this->dispatch('variant-generate');
    }

    public function generarCombinaciones($arrays, $indice = 0, $combinacion = [])
    {
        if ( $indice == count($arrays) ) {
            return [$combinacion];
        }
    
        $resultado = [];
    
        foreach ( $arrays[$indice] as $item ) {
            $combinacionTemporal = $combinacion;
            $combinacionTemporal[] = $item['id'];
            $resultado = array_merge($resultado, $this->generarCombinaciones($arrays, $indice + 1, $combinacionTemporal));
        }
    
        return $resultado;
    }

    public function featureChange($index)
    {
        $feature = Feature::find($this->variant['features'][$index]['id']);
        $this->variant['features'][$index]['value'] = $feature->value;
        $this->variant['features'][$index]['description'] = $feature->description;
    }

    public function isDisabled($value)
    {
        if( mb_strlen(trim($value)) == 0 )
        {
            return true;
        }
    }

    public function addFeature()
    {
        $this->variant['features'][] = [
            'id' => '',
            'value' => '',
            'description' => '',
        ];

        if ( $this->getErrorBag()->has('variant.features.*.id') )
        {
            $this->resetErrorBag('variant.features.*.id');
        }
    }

    public function removeFeature($index)
    {
        unset($this->variant['features'][$index]);
        $this->variant['features'] = array_values($this->variant['features']);
        $this->resetErrorBag('variant.features.' . $index . '.id');
    }

    public function deleteFeature($featureId, $optionId)
    {
        $this->product->options()->updateExistingPivot($optionId, [
            'features' => array_filter($this->product->options->find($optionId)->pivot->features, function($feature) use ($featureId){
                return $feature['id'] != $featureId;
            })
        ]);

        $this->dispatch('swal', [
            'icon' => 'info',
            'title' => 'Atención',
            'text' => 'Se elemino un valor',
        ]);

        $this->product = $this->product->fresh();

        $this->generarVariantes();

        $this->dispatch('refreshChildComponent');
        $this->dispatch('feature-deleted');
    }

    public function deleteOption(Option $option)
    {
        $this->product->options()->detach($option->id);

        $this->dispatch('swal', [
            'icon' => 'info',
            'title' => 'Atención',
            'text' => 'Se elemino una opción',
        ]);

        $this->product = $this->product->fresh();

        $this->getOptions();

        $this->generarVariantes();

        $this->dispatch('option-deleted');
    }

    public function refreshComponent()
    {
        $this->getOptions();
        $this->generarVariantes();
    }
}
