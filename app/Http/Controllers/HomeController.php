<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();

        $products = Product::with(['productImages', 'productCategory'])
            ->latest()
            ->paginate(12);

        return view('home', compact('products', 'categories'));
    }

    public function category($slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();

        $products = Product::with('productImages')
            ->where('product_category_id', $category->id)
            ->paginate(12);

        return view('category', compact('category', 'products'));
    }
}