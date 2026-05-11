@extends('admin.layout')
@section('title', 'Add Product')
@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" class="max-w-2xl">
    @csrf

    <div class="space-y-6">
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="admin-input" placeholder="e.g. Wireless Headphones" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Price ($)</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" class="admin-input" placeholder="99.99" required>
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="admin-input" placeholder="0" required>
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Main Image URL</label>
            <input type="url" name="main_image" value="{{ old('main_image') }}" class="admin-input" placeholder="https://images.unsplash.com/...">
            @error('main_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Thumbnail Images (comma-separated URLs)</label>
            <textarea name="thumbnail_images" rows="2" class="admin-input" placeholder="url1, url2, url3...">{{ old('thumbnail_images') }}</textarea>
            @error('thumbnail_images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Sizes Available (comma-separated)</label>
                <input type="text" name="sizes_available" value="{{ old('sizes_available') }}" class="admin-input" placeholder="S, M, L, XL">
                @error('sizes_available') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Colors Available (comma-separated)</label>
                <input type="text" name="colors_available" value="{{ old('colors_available') }}" class="admin-input" placeholder="Black, White, Gray">
                @error('colors_available') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Description</label>
            <textarea name="description" rows="4" class="admin-input" placeholder="Product description...">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-black text-white px-8 py-3 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">Create Product</button>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-black transition-colors">Cancel</a>
        </div>
    </div>
</form>
@endsection
