import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/authStore'

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
    component: PublisOfferView,
    meta: { requiresAuth: true, requiredRole: 'mentor' }, // Només accessible per mentors
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


// Guard per comprovar si l'usuari està autenticat i té el rol correcte
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();
  const userRole = localStorage.getItem('rol'); // Obtenim el rol de l'usuari des de localStorage

  // Comprovem si la ruta necessita autenticació
  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    alert('Per accedir a aquesta pàgina, has de iniciar sessió.');
    next('/login'); // Redirigeix a login si no està autenticat
  } 
  // Comprovem si la ruta té un rol requerit i si l'usuari té el rol adequat
  else if (to.meta.requiredRole && to.meta.requiredRole !== userRole) {
    alert('No tens permís per accedir a aquesta pàgina.');
    next('/forum'); // Redirigeix a la pàgina d'inici o a una altra pàgina d'error
  } 
  else {
    next(); // Permet l'accés si tot està bé
  }
});

export default router
