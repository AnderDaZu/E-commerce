<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'family_id' => 'required',
        ]);

        $family = Family::firstOrCreate(['name' => trim($request->family_id)]);

        $request['family_id'] = $family->id;

        $category = Category::create([
            'name' => $request->name,
            'family_id' => $request->family_id,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Se creo la categoría: ' . $category->name,
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => "required|unique:categories,name,$category->id",
            'family_id' => 'required',
        ]);

        $family = Family::firstOrCreate(['name' => trim($request->family_id)]);

        $request['family_id'] = $family->id;

        $category->update([
            'name' => $request->name,
            'family_id' => $request->family_id,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Categoría se actualizó con éxito',
        ]);

        return redirect()->route('admin.categories.edit', $category);
    }

    public function destroy(Category $category)
    {
        $categoryName = $category->name;

        if ( $category->subcategories->count() > 0 )
        {
            session()->flash('swal', [
                'icon' => 'warning',
                'title' => 'Ops!',
                'text' => 'No puedes eliminar la categoría: ' . $categoryName . ', porque tiene subcategorías vículadas',
            ]);

            return redirect()->back();
        }

        $category->delete();

        session()->flash('swal', [
            'icon' => 'info',
            'title' => '¡Atención!',
            'text' => 'Se eliminó la categoría: ' . $categoryName,
        ]);

        return redirect()->route('admin.categories.index');
    }
}
