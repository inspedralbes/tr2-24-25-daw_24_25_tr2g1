import { createRouter, createWebHistory } from 'vue-router'
import ForumPage from '../views/ForumView.vue'
import DetallesPage from '../views/DetallesView.vue'
import AuthPage from '../views/AuthView.vue'
import MentorsPage from '../views/MentorsView.vue'
import SearchOffer from '../views/SearchOfferView.vue'
import PublisOffer from '../views/PublishOfferView.vue'
import aboutUs from '../views/AboutUsView.vue'
import Contact from '../views/ContactView.vue'

const routes = [
  {
    path: '/forum',
    name: 'forum',
    component: ForumPage
  },
  {
    path: '/ad/:id',
    name: 'Detalles',
    component: DetallesPage
  },
  {
    path: '/auth',
    name: 'auth',
    component: AuthPage
  },
  {
    path: '/profiles',
    name: 'profiles',
    component: MentorsPage
  },
  {
    path: '/jobs',
    name: 'jobs',
    component: SearchOffer
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
  },
  {
    path: '/contact',
    name: 'contact',
    component: Contact 
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
