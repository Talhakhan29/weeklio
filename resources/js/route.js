import { createRouter, createWebHistory } from 'vue-router';
import Registration from './components/Registration.vue';
import Login from './components/Login.vue';

const routes = [
  { path: '/register', component: Registration },
  { path: '/', component: Login },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

