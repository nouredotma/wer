<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:2000',
            'main_image' => 'nullable|url|max:500',
            'thumbnail_images' => 'nullable|string',
            'sizes_available' => 'nullable|string',
            'colors_available' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Convert comma-separated strings to arrays
        if ($request->filled('thumbnail_images')) {
            $validated['thumbnail_images'] = array_map('trim', explode(',', $request->thumbnail_images));
        }
        if ($request->filled('sizes_available')) {
            $validated['sizes_available'] = array_map('trim', explode(',', $request->sizes_available));
        }
        if ($request->filled('colors_available')) {
            $validated['colors_available'] = array_map('trim', explode(',', $request->colors_available));
        }

        // Ensure unique slug
        $count = Product::where('slug', $validated['slug'])->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:2000',
            'main_image' => 'nullable|url|max:500',
            'thumbnail_images' => 'nullable|string',
            'sizes_available' => 'nullable|string',
            'colors_available' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Convert comma-separated strings to arrays
        if ($request->filled('thumbnail_images')) {
            $validated['thumbnail_images'] = array_map('trim', explode(',', $request->thumbnail_images));
        } else {
            $validated['thumbnail_images'] = [];
        }
        if ($request->filled('sizes_available')) {
            $validated['sizes_available'] = array_map('trim', explode(',', $request->sizes_available));
        } else {
            $validated['sizes_available'] = [];
        }
        if ($request->filled('colors_available')) {
            $validated['colors_available'] = array_map('trim', explode(',', $request->colors_available));
        } else {
            $validated['colors_available'] = [];
        }

        // Ensure unique slug (exclude current product)
        $count = Product::where('slug', $validated['slug'])->where('id', '!=', $id)->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
