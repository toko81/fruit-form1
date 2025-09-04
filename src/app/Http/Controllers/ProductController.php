<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {   
        $sortOrder = $request->input('sort_order', 'asc');
        $products = DB::table('products')->orderBy('price', $sortOrder)->get();

        return view('products', compact('products', 'sortOrder'));

    }

    public function registerForm()
    {
        return view('products.register'); 
    }

    public function confirm(RegisterRequest $request)
    {
        $contacts = $request->all();
        $category = Category::find($request->category_id);
        return view('confirm', compact('contacts', 'category'));
    }
    
    public function create()
    {
        $filename = null;
        return view('products.register', compact('filename'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0|max:1000000',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'donation' => 'required|in:none,yes,no,cow',
            'description' => 'required|string|max:120',
        ]);

        $imagePath = $request->file('image')->store('images/fruits-img', 'public');

        DB::table('products')->insert([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'image_path' => $imagePath,
        'created_at' => now(),
        'updated_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }

    public function search(SearchProductRequest $request)
    {
        $query = Product::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('price')) {
            $query->where('price', '<=', $request->price);
        }

        if ($request->filled('grade')) {
            $query->where('grade', $request->grade);
        }

        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        $products = $query->get();

        return view('products.index', compact('products')); 
    }

    public function updateForm($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();

        return view('products.update', compact('product', 'seasons'));
    }

}
