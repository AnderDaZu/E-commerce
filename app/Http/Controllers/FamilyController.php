<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Option;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function show(Family $family)
    {
        $options = Option::whereHas('products.subcategory.category', function ($query) use ($family) {
            $query->where('family_id', $family->id);
            })
            ->with([
                'features' => function ($query) use ($family) {
                    $query->whereHas('variants.product.subcategory.category', function ($query) use ($family) {
                        $query->where('family_id', $family->id);
                    });
                }
            ])
            ->get();

        return view('families.show', compact('family', 'options'));
    }
}
