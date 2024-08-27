<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
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

    public function variants(Product $product, Variant $variant)
    {
        // return $variant;
        return view('admin.products.variants', compact('product', 'variant'));
    }

    public function variantsUpdate(Request $request, Product $product, Variant $variant)
    {
        // return $request;
        $data = $request->validate([
            'image' => 'nullable|image|max:1024',
            'sku' => 'required|unique:variants,sku,' .$variant->id,
            'stock' => 'required|numeric|min:0',
        ]);

        if ( $request->image )
        {
            if ( $variant->image_path )
            {
                Storage::delete($variant->image_path);
            }

            $data['image_path'] = $request->image->store('public/products');
        }

        $variant->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Se actualizo la variante: ' . $variant->sku,
        ]);

        return redirect()->route('admin.products.variants', compact('product', 'variant'));
    }
}
