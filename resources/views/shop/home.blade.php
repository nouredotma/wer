@extends('shop.layout')
@section('content')
<section class="hero-home" style="background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=2000');">
    <div class="hero-overlay"></div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-7xl font-bold tracking-tighter mb-4 uppercase italic">Future of Retail</h1>
        <p class="text-xl tracking-widest uppercase mb-8 opacity-80">Premium essentials for the modern lifestyle</p>
        <a href="{{ route('products') }}" class="bg-white text-black px-10 py-4 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition-all">Shop Collection</a>
    </div>
</section>

<section class="py-20 px-10 max-w-7xl mx-auto">
    <div class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-4xl font-bold tracking-tighter uppercase mb-2">Featured Products</h2>
            <p class="text-gray-500 uppercase tracking-widest text-sm">Our most popular items this season</p>
        </div>
        <a href="{{ route('products') }}" class="underline decoration-2 underline-offset-8 uppercase tracking-widest font-bold text-sm">View All</a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($products as $product)
            <div class="group cursor-pointer">
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="aspect-[3/4] overflow-hidden bg-gray-100 mb-4 relative">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="bg-white text-black px-6 py-2 uppercase text-[10px] tracking-widest font-bold translate-y-4 group-hover:translate-y-0 transition-transform">View Details</span>
                        </div>
                    </div>
                </a>
                <a href="{{ route('products.show', $product->slug) }}">
                    <h3 class="font-bold uppercase tracking-tight">{{ $product->name }}</h3>
                </a>
                <p class="text-gray-500 text-sm">${{ number_format($product->price, 2) }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="bg-black text-white py-32 px-10 text-center">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-5xl font-bold tracking-tighter uppercase mb-6 italic">Join the evolution</h2>
        <p class="text-lg opacity-60 mb-10 tracking-wide uppercase">Subscribe to get early access to drops and exclusive offers.</p>
        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <input type="email" placeholder="ENTER YOUR EMAIL" class="bg-transparent border border-white/30 px-6 py-4 w-full md:w-80 focus:outline-none focus:border-white uppercase tracking-widest text-sm">
            <button class="bg-white text-black px-10 py-4 uppercase tracking-widest font-bold hover:bg-gray-200 transition-colors">Subscribe</button>
        </div>
    </div>
</section>
@endsection
