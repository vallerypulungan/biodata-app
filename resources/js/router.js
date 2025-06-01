import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from './pages/Dashboard.vue';
import Detail from './pages/index.vue'; // halaman detail CV

const routes = [
  { path: '/', redirect: '/dashboard' },
  { path: '/dashboard', component: Dashboard },
  { path: '/biodata/:id', component: Detail, name: 'biodata-detail' },
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
