<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', ['products' => Product::all()]);
    }
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'subscription_period' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')
            ->with('success', 'Product has been successfully created!');;
    }

    public function edit(Product $product)
    {
        return view('products.create', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'subscription_period' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')
            ->with('success', 'Product has been successfully edited!');
;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}

