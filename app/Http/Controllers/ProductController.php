<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.products.products', compact('products'));
    }
    public function create()
    {
        return view('backend.products.add');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:8048',
            'max_entries' => 'nullable|integer|min:1',
        ]);

        $path = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Products'), $filename);
            $path = 'Products/' . $filename;
        }

        Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'max_entries' => $request->max_entries,
            'is_active' => true,
        ]);

        return redirect()->route('products')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:8048',
            'max_entries' => 'nullable|integer|min:1',
        ]);

        $data = $request->only(['title', 'price', 'description', 'max_entries']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Products'), $filename);
            $data['image'] = 'Products/' . $filename;
        }

        $product->update($data);

        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
