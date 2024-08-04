<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::orderBy('id', 'desc')
            ->with('category.family')
            ->paginate(10);

        $subcategoriesCount = $subcategories->count();
        
        return view('admin.subcategores.index', compact('subcategories', 'subcategoriesCount'));
    }

    public function create()
    {
        return view('admin.subcategores.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Subcategory $subcategory)
    {
        //
    }

    public function edit(Subcategory $subcategory)
    {
        return view('admin.subcategores.edit', compact('subcategory'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    public function destroy(Subcategory $subcategory)
    {
        //
    }
}
