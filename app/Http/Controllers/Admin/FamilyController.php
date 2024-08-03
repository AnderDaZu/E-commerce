<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::orderBy('id', 'desc')->paginate(10);
        return view('admin.families.index', compact('families'));
    }

    public function create()
    {
        return view('admin.families.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:families,name',
        ]);

        $family = Family::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Se creo la familia: ' . $family->name,
        ]);

        return redirect()->route('admin.families.index');
    }

    public function show(Family $family)
    {
        //
    }

    public function edit(Family $family)
    {
        return view('admin.families.edit', compact('family'));
    }

    public function update(Request $request, Family $family)
    {
        $request->validate([
            'name' => "required|unique:families,name,$family->id",
        ]);

        $family->update($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Familia se actualizó con exíto',
        ]);

        return redirect()->route('admin.families.edit', $family);
    }

    public function destroy(Family $family)
    {
        $familyName = $family->name;
        $family->delete();

        session()->flash('swal', [
            'icon' => 'info',
            'title' => '¡Atención!',
            'text' => 'Se eliminó la familia: ' . $familyName,
        ]);
        
        return redirect()->route('admin.families.index');
    }
}
