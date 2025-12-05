import { createRouter, createWebHistory } from 'vue-router'
//import HomeView from '../views/HomeView.vue'
import CategoriesPage from '@/components/category/categoriesPage.vue'
import ProductsPage from '@/components/card/productsPage.vue'
import HomeView from '@/components/view/HomeView.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/categories/:categoryId',
      name: 'categories',
      component: CategoriesPage
    },
    {
      path: '/promotions/:promotionsId',
      name: 'promotions',
      component: ProductsPage,
    },
    {
      path: '/products/:productsId',
      name: 'products',
      component: ProductsPage,
    }

  ],
})

export default router
