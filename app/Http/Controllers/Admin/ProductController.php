<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')
            ->paginate(10);

        $productsCount = $products->count();

        return view('admin.products.index', compact('products', 'productsCount'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        Storage::delete($product->image_path);

        $productName = $product->name;
        
        $product->delete();

        session()->flash('swal', [
            'icon' => 'info',
            'title' => '¡Atención!',
            'text' => 'Se elimino el producto: ' . $productName,
        ]);

        return redirect()->route('admin.products.index');
    }
}
