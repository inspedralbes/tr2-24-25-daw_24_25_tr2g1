import { createRouter, createWebHistory } from 'vue-router'
import ForumPage from '..//views/ForumPage.vue'
import DetallesPage from '../views/DetallesPage.vue'
import AuthPage from '../views/AuthPage.vue'
import MentorsPage from '../views/MentorsPage.vue'
import SearchOffer from '../views/SearchOffer.vue'

const routes = [
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
    path: '/profiles',
    name: 'profiles',
    component: MentorsPage
  },
  {
    path: '/jobs',
    name: 'jobs',
    component: SearchOffer
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
