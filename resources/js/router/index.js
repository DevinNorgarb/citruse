import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import AppLayout from '@/components/Layout/AppLayout.vue'
import Login from '@/components/Auth/Login.vue'
import Dashboard from '@/components/Dashboard/Dashboard.vue'
import DistributorList from '@/components/Distributors/DistributorList.vue'
import PurchaseOrderList from '@/components/PurchaseOrders/PurchaseOrderList.vue'

const routes = [
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { requiresAuth: false },
  },
  {
    path: '/',
    component: AppLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        redirect: '/dashboard',
      },
      {
        path: 'dashboard',
        name: 'dashboard',
        component: Dashboard,
      },
      {
        path: 'distributors',
        name: 'distributors',
        component: DistributorList,
      },
      {
        path: 'purchase-orders',
        name: 'purchase-orders',
        component: PurchaseOrderList,
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore()
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth)

  if (requiresAuth && !authStore.isAuthenticated) {
    next('/login')
  } else if (to.path === '/login' && authStore.isAuthenticated) {
    next('/dashboard')
  } else {
    next()
  }
})

export default router