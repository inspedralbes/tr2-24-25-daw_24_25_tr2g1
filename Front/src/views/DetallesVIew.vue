<template>
  <div class="ad-details">
    <h2>{{ adDetails.titol }}</h2>
    <p>{{ adDetails.contingut }}</p>
    <button @click="signUp">Apuntarse</button>
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
  margin: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

h2 {
  font-size: 20px;
}

p {
  font-size: 16px;
}

button {
  margin-top: 10px;
  padding: 8px 12px;
  cursor: pointer;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
}

button:hover {
  background-color: #0056b3;
}
</style>
