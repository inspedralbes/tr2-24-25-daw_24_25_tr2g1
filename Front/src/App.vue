<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <nav id="navDesktop">
    <div class="logo">AlumNet</div>
    <div>
        <ul class="navElements">
            <!-- <li><RouterLink to="/experience">Classes</RouterLink></li> -->
            <li><RouterLink to="/login"><img src="/src/assets/icons/user.svg" alt="Login" width="25px"></RouterLink></li>
        </ul>
    </div>
  </nav>
  <div class="description">
    <p> ORGANITZA EL TEU APRENENTATGE I CONNECTA AMB COMPANYS D’ESTUDIS! </p>
    <div class="scroll-container">
      <p>Descobreix una plataforma on gestionar dades acadèmiques i trobar classes particulars amb altres alumnes.</p>
    </div>
  </div>
  <RouterView />
</template>

<style scoped>
</style>