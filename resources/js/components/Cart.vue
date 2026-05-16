<template>
  <Transition name="fade">
    <div v-if="isOpen" class="fixed inset-0 z-[200] bg-white overflow-y-auto">
      <!-- Back Button -->
      <button @click="closeCart" class="fixed top-4 left-4 md:top-8 md:left-8 z-[210] p-2 hover:opacity-50 transition-opacity">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6"/>
        </svg>
      </button>

      <div class="w-full px-3 md:px-12 py-12 md:py-24">
        <div v-if="cartItems.length === 0" class="min-h-[50vh] flex flex-col items-center justify-center text-center">
            <h2 class="text-4xl md:text-5xl tracking-tighter mb-6">Your bag is empty</h2>
            <button @click="closeCart" class="px-12 py-3 border border-black hover:bg-black hover:text-white transition-all duration-300 text-xs font-bold">
                Discover
            </button>
        </div>

        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-3 md:gap-12 items-start">
          <!-- Left Column: Bag Items -->
          <div class="space-y-8">
            <div>
              <h2 class="text-4xl md:text-5xl tracking-tighter mb-2">Bag</h2>
              <p class="text-neutral-500 text-sm">Total of {{ cartItems.length }} item{{ cartItems.length > 1 ? 's' : '' }}</p>
            </div>

            <div class="divide-y divide-neutral-100">
              <div v-for="item in cartItems" :key="item.id + '-' + (item.size || '') + '-' + (item.color || '')" class="py-6 flex gap-6">
                <div class="w-24 md:w-32 aspect-square bg-neutral-100 rounded-xl overflow-hidden shrink-0">
                  <img :src="item.image" class="w-full h-full object-cover" />
                </div>
                <div class="flex-1 flex flex-col">
                  <div class="flex justify-between items-start">
                    <div>
                      <h3 class="text-xl md:text-2xl tracking-tight">{{ item.name }}</h3>
                      <div class="flex gap-4 mt-1">
                        <p v-if="item.size" class="text-xs text-neutral-500">Size: {{ item.size }}</p>
                        <p v-if="item.color" class="text-xs text-neutral-500">Color: {{ item.color }}</p>
                      </div>
                    </div>
                    <button @click="removeItem(item.id, item.size, item.color)" class="p-1 text-neutral-300 hover:text-red-500 transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                  </div>
                  
                  <div class="flex items-center gap-4 mt-auto">
                    <div class="flex items-center border border-neutral-100 rounded-full px-3 py-1 bg-white">
                      <button @click="updateItemQty(item, -1)" class="px-2 hover:text-neutral-400 transition-colors">-</button>
                      <span class="w-8 text-center text-xs font-bold">{{ item.quantity }}</span>
                      <button @click="updateItemQty(item, 1)" class="px-2 hover:text-neutral-400 transition-colors">+</button>
                    </div>
                    <p class="font-bold text-lg ml-auto">{{ (item.price * item.quantity).toLocaleString() }} MAD</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-6 border-t border-neutral-100 flex justify-between items-end">
              <p class="text-neutral-500">Subtotal</p>
              <p class="text-3xl md:text-4xl font-bold tracking-tighter">{{ subtotal.toLocaleString() }} MAD</p>
            </div>
          </div>

          <!-- Right Column: Checkout Form -->
          <div class="bg-neutral-50 rounded-3xl p-6 md:p-10 border border-neutral-100">
            <h2 class="text-2xl md:text-3xl tracking-tight mb-6">Shipping Details</h2>
            
            <form @submit.prevent="submitOrder" class="space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                  <label class="text-[10px] font-bold text-neutral-500 ml-1">First Name</label>
                  <input v-model="form.first_name" type="text" required class="w-full px-5 py-3 rounded-xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="John">
                </div>
                <div class="space-y-1">
                  <label class="text-[10px] font-bold text-neutral-500 ml-1">Last Name</label>
                  <input v-model="form.last_name" type="text" required class="w-full px-5 py-3 rounded-xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="Doe">
                </div>
              </div>

              <div class="space-y-1">
                <label class="text-[10px] font-bold text-neutral-500 ml-1">Email Address</label>
                <input v-model="form.email" type="email" required class="w-full px-5 py-3 rounded-xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="john@example.com">
              </div>

              <div class="space-y-1">
                <label class="text-[10px] font-bold text-neutral-500 ml-1">Phone Number</label>
                <input v-model="form.phone" type="tel" required class="w-full px-5 py-3 rounded-xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="+212 600 000 000">
              </div>

              <div class="space-y-1">
                <label class="text-[10px] font-bold text-neutral-500 ml-1">Shipping Address</label>
                <input v-model="form.address" type="text" required class="w-full px-5 py-3 rounded-xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="Street name and number">
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                  <label class="text-[10px] font-bold text-neutral-500 ml-1">City</label>
                  <input v-model="form.city" type="text" required class="w-full px-5 py-3 rounded-xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="Casablanca">
                </div>
                <div class="space-y-1">
                  <label class="text-[10px] font-bold text-neutral-500 ml-1">Postal Code</label>
                  <input v-model="form.zip" type="text" class="w-full px-5 py-3 rounded-xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="20000">
                </div>
              </div>

              <div class="pt-6 border-t border-neutral-100">
                <div class="flex justify-between items-center mb-6">
                  <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100/50 flex items-center justify-center">
                      <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <p class="text-sm font-bold">Free Local Shipping</p>
                  </div>
                  <p class="text-sm font-bold text-emerald-600">Included</p>
                </div>

                <button type="submit" :disabled="isLoading" class="w-full bg-black text-white py-4 rounded-full font-bold text-base hover:bg-neutral-800 transition-all duration-300 disabled:opacity-50">
                  <span v-if="!isLoading">Complete Purchase — {{ subtotal.toLocaleString() }} MAD</span>
                  <span v-else>Processing...</span>
                </button>
                
                <p v-if="errorMessage" class="text-red-500 text-xs font-bold text-center mt-2">{{ errorMessage }}</p>
                
                <div class="flex items-center justify-center gap-4 text-neutral-300">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                  <p class="text-[8px] uppercase tracking-[0.2em]">Encrypted Protocol</p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

const isOpen = ref(false);
const cartItems = ref([]);
const isLoading = ref(false);
const errorMessage = ref('');

const form = ref({
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  address: '',
  city: '',
  zip: ''
});

const subtotal = computed(() => {
  return cartItems.value.reduce((total, item) => total + (item.price * item.quantity), 0);
});

const closeCart = () => {
  isOpen.value = false;
  document.body.style.overflow = '';
};

const openCart = () => {
  isOpen.value = true;
  document.body.style.overflow = 'hidden';
};

const removeItem = (id, size, color) => {
  cartItems.value = cartItems.value.filter(item => 
    !(item.id === id && item.size === size && item.color === color)
  );
  saveCart();
};

const updateItemQty = (item, delta) => {
  item.quantity = Math.max(1, item.quantity + delta);
  saveCart();
};

const saveCart = () => {
  localStorage.setItem('wer_cart', JSON.stringify(cartItems.value));
  window.dispatchEvent(new CustomEvent('cart-updated', { detail: cartItems.value }));
};

const submitOrder = async () => {
  if (cartItems.value.length === 0) {
      errorMessage.value = "Your cart is empty.";
      return;
  }
  
  isLoading.value = true;
  errorMessage.value = '';

  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const fullAddress = `${form.value.address}, ${form.value.city}, ${form.value.zip}`;
    
    const payload = {
      customer_name: `${form.value.first_name} ${form.value.last_name}`.trim(),
      customer_email: form.value.email,
      customer_phone: form.value.phone,
      address: fullAddress,
      items: cartItems.value.map(item => ({ id: item.id, quantity: item.quantity })),
    };

    const { data } = await axios.post('/checkout', payload, {
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
    });

    if (data.success) {
        alert(`Order Confirmed! Your Order ID is: #${data.order_id}`);
        cartItems.value = [];
        saveCart();
        closeCart();
        // Clear form
        form.value = { first_name: '', last_name: '', email: '', phone: '', address: '', city: '', zip: '' };
    } else {
        errorMessage.value = data.message || 'Something went wrong.';
    }
  } catch (err) {
      errorMessage.value = err.response?.data?.message || 'Unable to process your order. Please try again.';
  } finally {
      isLoading.value = false;
  }
};

onMounted(() => {
  const savedCart = localStorage.getItem('wer_cart');
  if (savedCart) {
    cartItems.value = JSON.parse(savedCart);
    window.dispatchEvent(new CustomEvent('cart-updated', { detail: cartItems.value }));
  }

  window.addEventListener('toggle-cart', () => {
    if (isOpen.value) closeCart();
    else openCart();
  });

  window.addEventListener('add-to-cart', (e) => {
    const item = e.detail;
    const existing = cartItems.value.find(i => 
        i.id === item.id && i.size === item.size && i.color === item.color
    );
    
    if (existing) {
      existing.quantity += item.quantity || 1;
    } else {
      cartItems.value.push({ ...item, quantity: item.quantity || 1 });
    }
    
    saveCart();
    openCart();
  });
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Minimalist scrollbar */
.fixed::-webkit-scrollbar {
  width: 2px;
}

.fixed::-webkit-scrollbar-track {
  background: white;
}

.fixed::-webkit-scrollbar-thumb {
  background: black;
}
</style>
