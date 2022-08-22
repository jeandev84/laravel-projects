import { createRouter, createWebHistory } from 'vue-router'
import Home from "@/views/Home.vue"
import SignIn from "@/views/SignIn";
import Dashboard from "@/views/Dashboard";


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
    component: Dashboard
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
