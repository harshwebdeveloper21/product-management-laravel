<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Product::query();


        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

   
        if ($request->has('size') && $request->size != '') {
            $query->where('size', $request->size);
        }

     
        if ($request->has('date_from') && $request->date_from != '') {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->where('date', '<=', $request->date_to);
        }

        $products = $query->paginate(10);

        return view('products.index', compact('products'));
    }

 
    public function create()
    {
        return view('products.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'required|string|max:50',
            'date' => 'required|date',
        ]);

        $data = $request->only(['name', 'size', 'date']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

  
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

   
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'required|string|max:50',
            'date' => 'required|date',
        ]);

        $data = $request->only(['name', 'size', 'date']);

        if ($request->hasFile('image')) {
           
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
      
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
