<template>
  <div class="ad-details">
    <h2>{{ adDetails.titol }}</h2>
    <p>{{ adDetails.contingut }}</p>
    <p>Especialitat: {{ adDetails.especialitat }}</p>
    <p>Mentor: {{ adDetails.mentor }}</p>
    <p>Horari: {{ adDetails.horainici }}</p>
    <button @click="signUp">Inscriure'm</button>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { getAdDetails } from '../services/communicationManager.js'

const route = useRoute()
const router = useRouter()
const adDetails = ref({})

onMounted(async () => {
  const adId = route.params.id; // Obtiene el ID de la URL
  adDetails.value = await getAdDetails(adId)
})

const signUp = () => {
  router.push('/auth')
}
</script>
<style scoped>
.ad-details {
  width: 800px;
  height: 360px;
  /* max-width: 600px; */
  margin: 30px auto;
  padding: 25px;
  background-color: #f9f9fa;
  border-radius: 12px;
  border: 1px solid #e1e4e8;
}

h2 {
  color: #2c3e50;
  font-size: 22px;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid #007bff;
}

p {
  color: #4a4a4a;
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 25px;
}

button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-size: 16px;
}

button:hover {
  background-color: #0056b3;
}
</style>
