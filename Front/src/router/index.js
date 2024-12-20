import { createRouter, createWebHistory } from 'vue-router'
import ForumPage from '../views/ForumView.vue'
import DetallesPage from '../views/DetallesView.vue'
import AuthPage from '../views/AuthView.vue'
import MentorsPage from '../views/MentorsView.vue'
import SearchOfferView from '../views/SearchOfferView.vue'
import PublisOfferView from '../views/PublishOfferView.vue'
import aboutUs from '../views/AboutUsView.vue'
import Contact from '../views/ContactView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'

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
    component: SearchOfferView
  },
  {
    path: '/publish',
    name: 'publish',
    component: PublisOfferView 
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
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
