import { createRouter, createWebHistory } from 'vue-router'
import Home from "@/views/Home.vue"
import SignIn from "@/views/SignIn";
import Dashboard from "@/views/Dashboard";
import store from "@/store";


const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/signin',
    name: 'signin',
    component: SignIn
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    beforeEnter: (to, from, next) => {

         // console.log('middleware dashboard');
         // console.log(store.getters);

         if (!store.getters['auth/authenticated']) {
              return next({
                 name: 'signin'
              });
         }

         next();
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
