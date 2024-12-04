import { createRouter, createWebHistory } from 'vue-router'
import LandingPage from '../views/LandingPage.vue'  // Ruta principal
import ForumPage from '..//views/ForumPage.vue'
import DetallesPage from '../views/DetallesPage.vue'
import AuthPage from '../views/AuthPage.vue'
import PublisOffer from '../views/PublishOffer.vue'
import aboutUs from '../views/aboutUs.vue'

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
  },
  {
    path: '/publish',
    name: 'publish',
    component: PublisOffer 
  },
  {
    path: '/aboutUs',
    name: 'aboutUs',
    component: aboutUs 
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
