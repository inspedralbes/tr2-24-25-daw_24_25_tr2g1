<script setup>
import { RouterLink, RouterView } from 'vue-router';
import { useRouter } from 'vue-router';
import { ref, onMounted, computed } from 'vue';
import { useAuthStore } from './stores/authStore';
import GestionUsuarios from './views/GestionUsuarios.vue';


let isNavBarClicked = ref(false);
const router = useRouter();
const authStore = useAuthStore();
const userId = computed(() => authStore.userId);
const GestionUsuariosRef = ref(null);

// Comprova si l'usuari està autenticat en carregar l'aplicació
onMounted(() => {
  authStore.checkAuth();  // Esto carga el estado desde el store automáticamente
});

// Comprova si l'usuari està autenticat
const isAuthenticated = computed(() => authStore.isAuthenticated);

// Verificar el rol de l'usuari de manera reactiva
const userRole = computed(() => authStore.rol);

// Función para verificar si el usuario puede publicar una oferta
const canPublishOffer = computed(() => {
  return userRole.value === 'mentor' || userRole.value === 'professor';
});

// Función para abrir la ventana de gestión de usuarios
const openUsersManagement = () => {
  if (userRole.value === 'professor') {
    GestionUsuariosRef.value?.togglePopup();
  }
}


// Funció per gestionar el logout
const handleLogout = () => {
  authStore.logout();
  router.push('/');
};
</script>

<template>
  <nav id="navDesktop">
    <div class="logo" @click="(router.push('/'), (isNavBarClicked = false))">AlumNet</div>
    <div>
      <template v-if="isAuthenticated">


        <img v-if="userRole === 'professor'" src="/src/assets/icons/lista.png" alt="Gestió d'usuaris"
          @click="openUsersManagement" class="nav-icon" />

        <span> {{ userRole }}</span>
        <button @click="handleLogout"><img src="/src/assets/icons/out.svg" alt="LogOut" width="25px"></button>
      </template>
      <template v-else>
        <RouterLink to="/login" @click="isNavBarClicked = true"><img src="/src/assets/icons/user.svg" alt="Login"
            width="25px" /></RouterLink>
      </template>
    </div>
  </nav>


    <GestionUsuarios ref="GestionUsuariosRef" />

  <div class="description" v-if="!isNavBarClicked">
    <p>ORGANITZA EL TEU APRENENTATGE I CONNECTA AMB COMPANYS D’ESTUDIS!</p>
    <div class="scroll-container">
      <p>
        Descobreix una plataforma on gestionar dades acadèmiques i trobar classes particulars amb
        altres alumnes.
      </p>
    </div>
  </div>

  <div class="landing-nav">
    <RouterLink to="/forum" @click="isNavBarClicked = true" class="button">FÒRUM</RouterLink>
    <RouterLink to="/profiles" @click="isNavBarClicked = true" class="button">MENTORS</RouterLink>
    <RouterLink to="/jobs" @click="isNavBarClicked = true" class="button">BUSCAR OFERTES</RouterLink>
    <RouterLink v-if="canPublishOffer" to="/publish" @click="isNavBarClicked = true" class="button">PUBLICAR OFERTA
    </RouterLink>
    <RouterLink to="/aboutUs" @click="isNavBarClicked = true" class="button">SOBRE NOSALTRES</RouterLink>
    <RouterLink to="/contact" @click="isNavBarClicked = true" class="button">CONTACTE</RouterLink>
  </div>

  <div class="container">
    <RouterView />
  </div>

  <div>
    <footer>
      <p>© 2024 AlumNet. Tots els drets reservats.</p>
    </footer>
  </div>
</template>

<style scoped>
.button:hover {
  background-color: rgb(169, 169, 169);
  color: black;
}
.nav-icon {
  width: 25px;
  height: 25px;
  cursor: pointer;
  margin: 0 10px;
}
</style>
