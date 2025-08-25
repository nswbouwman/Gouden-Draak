import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Vue setup
import { createApp } from 'vue';
import OrderButton from './components/OrderButton.vue';
import DeleteButton from './components/DeleteButton.vue';

const app = createApp({});
app.component('order-button', OrderButton);
app.component('delete-button', DeleteButton);
app.mount('#vue-menu');