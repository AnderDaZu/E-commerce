<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function show(Subcategory $subcategory)
    {
        return view('subcategories.show', compact('subcategory'));
    }
}
