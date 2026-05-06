import './bootstrap';
import { createApp } from 'vue';

import Cart from './components/Cart.vue';
import CartItem from './components/CartItem.vue';
import MiniCart from './components/MiniCart.vue';
import ProductCard from './components/ProductCard.vue';
import ProductGallery from './components/ProductGallery.vue';
import ProductFilter from './components/ProductFilter.vue';
import QuantitySelector from './components/QuantitySelector.vue';
import CheckoutForm from './components/CheckoutForm.vue';
import ContactForm from './components/ContactForm.vue';

const app = createApp({});

app.component('Cart', Cart);
app.component('CartItem', CartItem);
app.component('MiniCart', MiniCart);
app.component('ProductCard', ProductCard);
app.component('ProductGallery', ProductGallery);
app.component('ProductFilter', ProductFilter);
app.component('QuantitySelector', QuantitySelector);
app.component('CheckoutForm', CheckoutForm);
app.component('ContactForm', ContactForm);

app.mount('#app');

// Sticky Header Logic
const header = document.querySelector('nav.header-transparent');
if (header) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.remove('bg-transparent', 'text-white');
            header.classList.add('bg-white', 'text-black', 'shadow-md', 'py-4');
        } else {
            header.classList.add('bg-transparent', 'text-white');
            header.classList.remove('bg-white', 'text-black', 'shadow-md', 'py-4');
        }
    });
}
