@extends('shop.layout')
@section('content')
<div class="pt-32 pb-24 px-10 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
        <!-- Left: Image Gallery -->
        <div class="space-y-6">
            <div class="aspect-[4/5] bg-gray-50 overflow-hidden rounded-2xl">
                <img id="mainImage" src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            <div class="grid grid-cols-4 gap-4">
                <div class="aspect-square bg-gray-50 overflow-hidden rounded-lg cursor-pointer border-2 border-black">
                    <img src="{{ $product->image }}" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition-opacity">
                </div>
                <!-- Mock Thumbnails -->
                @for($i = 1; $i <= 3; $i++)
                <div class="aspect-square bg-gray-50 overflow-hidden rounded-lg cursor-pointer">
                    <img src="https://images.unsplash.com/photo-{{ 1500000000000 + ($i * 100000) }}?q=80&w=1000" class="w-full h-full object-cover opacity-40 hover:opacity-100 transition-opacity">
                </div>
                @endfor
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="flex flex-col">
            <nav class="flex gap-2 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-8">
                <a href="{{ route('home') }}" class="hover:text-black">Home</a>
                <span>/</span>
                <a href="{{ route('products') }}" class="hover:text-black">Products</a>
                <span>/</span>
                <span class="text-black">{{ $product->name }}</span>
            </nav>

            <h1 class="text-5xl font-bold tracking-tighter uppercase italic mb-4">{{ $product->name }}</h1>
            <p class="text-3xl font-bold tracking-tighter mb-8">${{ number_format($product->price, 2) }}</p>
            
            <div class="prose prose-sm text-gray-500 mb-12">
                <p class="text-lg leading-relaxed">{{ $product->description }}</p>
            </div>

            <div class="space-y-6 mt-auto">
                <div class="flex flex-col gap-2">
                    <span class="text-xs font-bold uppercase tracking-widest text-gray-400 ml-1">Quantity</span>
                    <div class="flex items-center w-32 border border-gray-200 rounded-lg p-1">
                        <button onclick="decrement()" class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 rounded-md transition-colors">-</button>
                        <input id="qty" type="number" value="1" min="1" class="w-full text-center font-bold bg-transparent focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        <button onclick="increment()" class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 rounded-md transition-colors">+</button>
                    </div>
                </div>

                <button onclick="addToCart()" class="w-full bg-black text-white py-5 rounded-xl font-bold uppercase tracking-widest hover:bg-gray-800 transition-all flex items-center justify-center gap-4 group">
                    <span>Add to Bag</span>
                    <svg class="group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>

                <div class="grid grid-cols-2 gap-4 pt-8 border-t border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                        </div>
                        <span class="text-[10px] uppercase tracking-widest font-bold">Secure Payment</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                        </div>
                        <span class="text-[10px] uppercase tracking-widest font-bold">2 Year Warranty</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function increment() {
        const input = document.getElementById('qty');
        input.value = parseInt(input.value) + 1;
    }
    function decrement() {
        const input = document.getElementById('qty');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
    function addToCart() {
        const product = @json($product);
        const qty = parseInt(document.getElementById('qty').value);
        window.dispatchEvent(new CustomEvent('add-to-cart', {
            detail: {
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.image,
                quantity: qty
            }
        }));
    }
</script>
@endsection
