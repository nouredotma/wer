@extends('admin.layout')
@section('title', 'Edit Product')
@section('content')
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="max-w-2xl">
    @csrf
    @method('PUT')

    <div class="space-y-6">
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="admin-input" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Price ($)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" class="admin-input" required>
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" class="admin-input" required>
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Main Image URL</label>
            <input type="url" name="main_image" value="{{ old('main_image', $product->main_image) }}" class="admin-input">
            @if($product->main_image)
            <div class="mt-3 w-24 h-24 bg-gray-50 rounded-lg overflow-hidden">
                <img src="{{ $product->main_image }}" class="w-full h-full object-cover">
            </div>
            @endif
            @error('main_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Thumbnail Images (comma-separated URLs)</label>
            <textarea name="thumbnail_images" rows="2" class="admin-input" placeholder="url1, url2, url3...">{{ old('thumbnail_images', is_array($product->thumbnail_images) ? implode(', ', $product->thumbnail_images) : '') }}</textarea>
            @error('thumbnail_images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Sizes Available (comma-separated)</label>
                <input type="text" name="sizes_available" value="{{ old('sizes_available', is_array($product->sizes_available) ? implode(', ', $product->sizes_available) : '') }}" class="admin-input" placeholder="S, M, L, XL">
                @error('sizes_available') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Colors Available (comma-separated)</label>
                <input type="text" name="colors_available" value="{{ old('colors_available', is_array($product->colors_available) ? implode(', ', $product->colors_available) : '') }}" class="admin-input" placeholder="Black, White, Gray">
                @error('colors_available') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Description</label>
            <textarea name="description" rows="4" class="admin-input">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-black text-white px-8 py-3 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-black transition-colors">Cancel</a>
        </div>
    </div>
</form>
@endsection
