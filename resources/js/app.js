import { createApp } from 'vue';
import router from './router.js'; // router kamu
import App from './App.vue'; // root component

createApp(App).use(router).mount('#app');
