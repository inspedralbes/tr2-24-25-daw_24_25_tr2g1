import { createRouter, createWebHistory } from 'vue-router'
import LandingPage from '../views/LandingPage.vue'  // Ruta principal
import ForumPage from '..//views/ForumPage.vue'
import DetallesPage from '../views/DetallesPage.vue'
import AuthPage from '../views/AuthPage.vue'

const routes = [
  {
    path: '/',
    name: 'landing',  // pagina principal
    component: LandingPage
  },
  {
    path: '/forum',
    name: 'forum',
    component: ForumPage
  },
  {
    path: '/ad/:id',
    name: 'DetallesPage',
    component: DetallesPage
  },
  {
    path: '/auth',
    name: 'auth',
    component: AuthPage
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
