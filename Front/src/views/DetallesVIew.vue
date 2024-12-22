<template>
  <div class="ad-details">
    <h2>{{ adDetails.titol }}</h2>
    <p>{{ adDetails.contingut }}</p>
    <p>Especialitat: {{ adDetails.especialitat }}</p>
    <p>Mentor: {{ adDetails.mentor }}</p>
    <p>Dia: {{ adDetails.data_publicacio }}</p>
    <p>Horari: {{ adDetails.hora_inici }}h - {{ adDetails.hora_final }}h</p>
    <div v-if="isAuthenticated">
      <button @click="signUp">Inscriure'm</button>
    </div>
    <div v-else>
      <p>Per inscriure't a aquesta classe, has de <router-link to="/login">iniciar sessió</router-link>.</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { getAdDetails } from '../services/communicationManager.js'
import { useAuthStore } from '../stores/authStore.js' // Importa el teu store d'autenticació

const route = useRoute()
const router = useRouter()
const adDetails = ref({})

// Obtenir les dades de l'oferta
onMounted(async () => {
  const adId = route.params.id; // Obtiene el ID de la URL
  adDetails.value = await getAdDetails(adId)
})

// Comprovem si l'usuari està autenticat
const authStore = useAuthStore()
const isAuthenticated = computed(() => authStore.isAuthenticated)

// Funció d'inscripció
const signUp = () => {
  if (isAuthenticated.value) {
    alert('T\'has inscrit a la classe!')
    // Aquí pots afegir la lògica real per inscriure's a la classe (API, etc.)
  } else {
    router.push('/login') // Redirigir a login si no està autenticat
  }
}

</script>

<style scoped>
.ad-details {
  width: 800px;
  height: 450px;
  margin: 30px auto;
  padding: 25px;
  background-color: #f9f9fa;
  border-radius: 12px;
  border: 1px solid #e1e4e8;
}

h2 {
  color: #000000;
  font-size: 22px;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid #000000;
}

p {
  color: #4a4a4a;
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 25px;
}

button {
  padding: 10px 20px;
  background-color: #000000;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-size: 16px;
}

button:hover {
  background-color: lightgrey;
  color: black;
}
</style>
