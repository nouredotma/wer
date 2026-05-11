@extends('shop.layout')
@section('content')
<section class="pt-32 pb-24 section-padding">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">
        <!-- Image Gallery -->
        <div class="space-y-6">
            <div class="aspect-square bg-neutral-50 rounded-3xl overflow-hidden shadow-sm">
                <img id="mainImage" src="{{ $product->main_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            @if($product->thumbnail_images && count($product->thumbnail_images) > 0)
            <div class="grid grid-cols-4 gap-4">
                @foreach($product->thumbnail_images as $thumb)
                <div class="aspect-square bg-neutral-50 rounded-2xl overflow-hidden cursor-pointer hover:opacity-80 transition-opacity"
                     onclick="document.getElementById('mainImage').src='{{ $thumb }}'">
                    <img src="{{ $thumb }}" class="w-full h-full object-cover">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Product Details -->
        <div class="flex flex-col">
            <div class="mb-10">
                <p class="text-[10px] text-gray-400 uppercase tracking-[0.4em] mb-3">Product #{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</p>
                <h1 class="text-4xl md:text-6xl font-light tracking-tight mb-6">{{ $product->name }}</h1>
                <p class="text-2xl font-medium text-gray-800 mb-8">${{ number_format($product->price, 2) }}</p>
                <p class="text-gray-500 leading-relaxed font-light text-lg mb-10 max-w-xl">
                    {{ $product->description ?? 'No description provided.' }}
                </p>
            </div>

            <div class="space-y-12">
                @if($product->sizes_available && count($product->sizes_available) > 0)
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest mb-6">Select Size</h4>
                    <div class="flex flex-wrap gap-3">
                        @foreach($product->sizes_available as $size)
                        <button class="px-8 py-3 border border-neutral-200 rounded-xl text-sm font-medium hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                            {{ $size }}
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($product->colors_available && count($product->colors_available) > 0)
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest mb-6">Select Color</h4>
                    <div class="flex flex-wrap gap-3">
                        @foreach($product->colors_available as $color)
                        <button class="px-8 py-3 border border-neutral-200 rounded-xl text-sm font-medium hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                            {{ $color }}
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="mt-16 pt-10 border-t border-neutral-100 flex flex-col sm:flex-row items-center gap-6">
                <div class="flex items-center border border-neutral-200 rounded-full px-6 py-3 bg-neutral-50/50">
                    <button class="text-xl px-3 hover:text-gray-400 transition-colors">-</button>
                    <input type="text" value="1" class="w-12 text-center bg-transparent outline-none font-medium">
                    <button class="text-xl px-3 hover:text-gray-400 transition-colors">+</button>
                </div>
                <button class="w-full sm:w-auto flex-1 bg-black text-white px-12 py-5 rounded-full font-bold text-sm uppercase tracking-widest hover:bg-neutral-800 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 shadow-xl shadow-black/5">
                    Add to Cart — ${{ number_format($product->price, 2) }}
                </button>
            </div>
            
            <div class="mt-12 flex items-center gap-8 text-[10px] uppercase tracking-widest font-bold text-gray-400">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Secure Checkout
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Free Shipping
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products (Footer Scroller alternative) -->
<section class="py-24 border-t border-neutral-100 section-padding">
    <h2 class="text-2xl font-light tracking-tight mb-12">You might also like</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
        @foreach(\App\Models\Product::where('id', '!=', $product->id)->take(4)->get() as $related)
        <a href="{{ route('products.show', $related->slug) }}" class="group">
            <div class="aspect-square bg-neutral-50 rounded-2xl overflow-hidden mb-4">
                <img src="{{ $related->main_image }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            </div>
            <h4 class="text-sm font-medium tracking-tight mb-1">{{ $related->name }}</h4>
            <p class="text-xs text-gray-500">${{ number_format($related->price, 2) }}</p>
        </a>
        @endforeach
    </div>
</section>
@endsection
