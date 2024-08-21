<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use Livewire\Component;

class AddNewFeature extends Component
{
    public $product;
    public $optionId;
    public $options;
    public $productType;
    public $featuresFree;
    public $featureSelected;
    public $featuresIncluded;

    protected $listeners = ['refreshChildComponent' => 'refreshComponent'];


    public function isDisabled($value)
    {
        if( !$this->featureSelected )
        {
            return true;
        }
    }
    public function mount()
    {
        $this->options = $this->product->toArray()['options'];
        $this->featuresFree = $this->getFeaturesFree();
    }

    public function render()
    {
        return view('livewire.admin.products.add-new-feature');
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if( $validator->fails() )
            {
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'Debe seleccionar una opción',
                ]);
            }
        });
    }

    public function getFeaturesFree()
    {
        $optionId = $this->optionId;

        $index = array_search($optionId, array_column($this->options, 'id'));

        $this->productType = $this->product->options[$index]->toArray()['type'];

        $idsFeaturesIncluded = array_column($this->product->options[$index]->toArray()['pivot']['features'], 'id');
        $this->featuresIncluded = $this->product->options[$index]->toArray()['pivot']['features'];

        $features = Feature::where('option_id', $optionId)
            ->whereNotIn('id', $idsFeaturesIncluded)
            ->get();

        return $features;
    }

    public function addFeature()
    {
        $this->validate([
            'featureSelected' => 'required|exists:features,id',
        ], [], [
            'featureSelected' => 'valor',
        ]);

        $feature = Feature::select('id', 'value', 'description')->find($this->featureSelected)->toArray();

        $this->featuresIncluded[] = $feature;

        $this->product->options()->updateExistingPivot($this->optionId, [
            'features' => $this->featuresIncluded,
        ]);

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Éxito',
            'text' => 'Se agregó la característica correctamente',
        ]);

        $this->reset('featureSelected', 'featuresFree');

        $this->featuresFree = $this->getFeaturesFree();

        $this->dispatch('refreshParentComponent');
    }

    public function refreshComponent()
    {
        $this->featuresFree = $this->getFeaturesFree();
    }
}
