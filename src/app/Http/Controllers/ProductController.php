<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Season;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        if ($request->filled('sort')) {
            $direction = $request->sort === 'asc' ? 'asc' : 'desc';
            $query->orderBy('price', $direction);
        }

        $products = $query->paginate(6);

        return view('products.products', compact('products'));

    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $validated['image'],
            'image_path' => $path,
            'season' => $validated['season'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('products.index')->with('success', '商品を登録しました');

    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));

    }



    

    public function registerForm()
    {
        $files = File::files(public_path('images'));
        $images = array_map(function($file) {
            return basename($file);
        }, $files);

        return view('products.register', compact('images')); 
    }

    public function confirm(RegisterRequest $request)
    {
        $contacts = $request->all('name','price','image','season',description);
        $category = Category::find($request->category_id);
        return view('confirm', compact('contacts', 'category'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort');

        $query = Product::query();

        if ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(6);

        return view('search', compact('products', 'keyword'));

    }

    public function updateForm($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();

        return view('products.update', compact('product', 'seasons'));
    }

}
