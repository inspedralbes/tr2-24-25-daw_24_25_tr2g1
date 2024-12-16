<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useRouter } from 'vue-router'
import { ref } from 'vue'

let isNavBarClicked = ref(false)
const router = useRouter()

</script>

<template>
  <div class="contenidoBody">
    <nav id="navDesktop">
      <div class="logo" @click="(router.push('/'), (isNavBarClicked = false))">AlumNet</div>
      <div>
          <!-- <li><RouterLink to="/experience">Classes</RouterLink></li> -->
          <RouterLink to="/login" @click="isNavBarClicked = true"><img src="/src/assets/icons/user.svg" alt="Login" width="25px"></RouterLink>
      </div>
    </nav>
    <div class="description" v-if="!isNavBarClicked">
      <p>ORGANITZA EL TEU APRENENTATGE I CONNECTA AMB COMPANYS D’ESTUDIS!</p>
      <div class="scroll-container">
        <p>
          Descobreix una plataforma on gestionar dades acadèmiques i trobar classes particulars amb
          altres alumnes.
        </p>
      </div>
    </div>
  
    <div class="scroll-container-mobile" v-if="isNavBarClicked">
      <p>
        Descobreix una plataforma on gestionar dades acadèmiques i trobar classes particulars amb
        altres alumnes.
      </p>
    </div>
  
    <!-- Desktop View -->
    <div class="landing-nav">
      <RouterLink to="/forum" @click="isNavBarClicked = true" class="button">FORO</RouterLink>
      <RouterLink to="/profiles" @click="isNavBarClicked = true" class="button">MENTORS</RouterLink>
      <RouterLink to="/jobs" @click="isNavBarClicked = true" class="button">BUSCAR OFERTES</RouterLink>
      <RouterLink to="/publish" @click="isNavBarClicked = true" class="button">PUBLICAR OFERTA</RouterLink>
      <RouterLink to="/aboutUs" @click="isNavBarClicked = true" class="button">SOBRE NOSALTRES</RouterLink>
      <RouterLink to="/contact" @click="isNavBarClicked = true" class="button">CONTACTE</RouterLink>
    </div>
  
    <!-- Mobile View -->
    <div class="landing-nav-mobile">
      <RouterLink to="/forum" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/foro.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/profiles" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/mentor.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/jobs" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/buscar.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/publish" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/publicar.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/aboutUs" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/sobrenosaltres.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/contact" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/contacte.png" width="25vh"
      /></RouterLink>
    </div>
  
    <!-- Contingut per la pàgina -->
    <div class="container">
      <RouterView />
    </div>

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
</style>