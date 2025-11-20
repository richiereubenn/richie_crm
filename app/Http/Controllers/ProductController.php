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

    public function destroy(Project $project)
    {
        if (Auth::user()->role !== 'Sales') abort(403);

        $project->delete();

        return redirect()->route('projects.index');
    }
}

