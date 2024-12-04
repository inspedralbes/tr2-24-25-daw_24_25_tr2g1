<template>
  <div class="landing-container">
    <button @click="goToForum">Foro</button>
    <button @click="goToProfiles">Mentors</button>
    <button @click="goToJobs">Buscar Ofertes</button>
    <button @click="goToPostJob">Publicar Oferta</button>
    <button @click="goToAbout">Sobre nosaltres</button>
    <button @click="goToContact">Contacte</button>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const goToForum = () => {
  console.log('Navegando al foro...');
  router.push('/forum')  
}

const goToProfiles = () => {
  router.push('/profiles')
}

const goToJobs = () => {
  router.push('/jobs')
}

const goToPostJob = () => {
  router.push('/post-job')
}

const goToAbout = () => {
  router.push('/about')
}

const goToContact = () => {
  router.push('/contact')
}
</script>
