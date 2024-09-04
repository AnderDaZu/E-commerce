<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cover;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CoverController extends Controller
{
    public function index()
    {
        return view('admin.covers.index');
    }

    public function create()
    {
        return view('admin.covers.create');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $data = $request->validate([
            'image' => 'required|image|max:1024',
            'title' => 'required|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:date_start',
            'is_active' => 'required|boolean',
        ]);

        $data['image_path'] = Storage::put('covers', $request->image);

        $cover = Cover::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Se creo portada: ' . $cover->title,
        ]);

        return redirect()->route('admin.covers.index');
    }

    public function show(Cover $cover)
    {
        //
    }

    public function edit(Cover $cover)
    {
        return view('admin.covers.edit', compact('cover'));
    }

    public function update(Request $request, Cover $cover)
    {
        //
    }

    public function destroy(Cover $cover)
    {
        //
    }
}
