<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useRouter } from 'vue-router'
import { ref } from 'vue';

let isNavBarClicked = ref(false);
const router = useRouter();


const goToForum = () => {
  console.log('Navegando al foro...');
  router.push('/forum');
  isNavBarClicked.value = true;
}


const goToProfiles = () => {
  router.push('/profiles');
  isNavBarClicked.value = true;
}

const goToJobs = () => {
  router.push('/jobs');
  isNavBarClicked.value = true;
}

const goToPostJob = () => {
  router.push('/publish');
  isNavBarClicked.value = true;
}

const goToAbout = () => {
  router.push('/aboutUs');
  isNavBarClicked.value = true;
}

const goToContact = () => {
  router.push('/contact');
  isNavBarClicked.value = true;
}

</script>

<template>
  <nav id="navDesktop">
    <div class="logo" @click="router.push('/'), isNavBarClicked = false">AlumNet</div>
    <div>
            <!-- <li><RouterLink to="/experience">Classes</RouterLink></li> -->
            <RouterLink to="/login" @click="isNavBarClicked = true"><img src="/src/assets/icons/user.svg" alt="Login" width="25px"></RouterLink>
    </div>
  </nav>
  <div class="description" v-if="!isNavBarClicked">
    <p> ORGANITZA EL TEU APRENENTATGE I CONNECTA AMB COMPANYS D’ESTUDIS! </p>
    <div class="scroll-container">
      <p>Descobreix una plataforma on gestionar dades acadèmiques i trobar classes particulars amb altres alumnes.</p>
    </div>
  </div>

  <!-- Desktop View -->
  <div class="landing-nav">
    <RouterLink to="/forum" @click="isNavBarClicked = true"  class="button">FORO</RouterLink>
    <RouterLink to="/profiles" @click="isNavBarClicked = true"  class="button">MENTORS</RouterLink>
    <RouterLink to="/jobs" @click="isNavBarClicked = true"  class="button">BUSCAR OFERTES</RouterLink>
    <RouterLink to="/publish" @click="isNavBarClicked = true"  class="button">PUBLICAR OFERTA</RouterLink>
    <RouterLink to="/aboutUs" @click="isNavBarClicked = true"  class="button">SOBRE NOSALTRES</RouterLink>
    <RouterLink to="/contact" @click="isNavBarClicked = true"  class="button">CONTACTE</RouterLink>
    <!-- <button @click="goToForum">Foro</button>
    <button @click="goToProfiles">Mentors</button>
    <button @click="goToJobs">Buscar Ofertes</button>
    <button @click="goToPostJob">Publicar Oferta</button>
    <button @click="goToAbout">Sobre nosaltres</button>
    <button @click="goToContact">Contacte</button> -->
  </div>

  <!-- Mobile View -->
  <div class="landing-nav-mobile">
    <RouterLink to="/forum" @click="isNavBarClicked = true"  class="button"><img src="/src/assets/icons/foro.png" width="25vh"></RouterLink>
    <RouterLink to="/profiles" @click="isNavBarClicked = true"  class="button"><img src="/src/assets/icons/mentor.png" width="25vh"></RouterLink>
    <RouterLink to="/jobs" @click="isNavBarClicked = true"  class="button"><img src="/src/assets/icons/buscar.png" width="25vh"></RouterLink>
    <RouterLink to="/publish" @click="isNavBarClicked = true"  class="button"><img src="/src/assets/icons/publicar.png" width="25vh"></RouterLink>
    <RouterLink to="/aboutUs" @click="isNavBarClicked = true"  class="button"><img src="/src/assets/icons/sobrenosaltres.png" width="25vh"></RouterLink>
    <RouterLink to="/contact" @click="isNavBarClicked = true"  class="button"><img src="/src/assets/icons/contacte.png" width="25vh"></RouterLink>
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
</style>