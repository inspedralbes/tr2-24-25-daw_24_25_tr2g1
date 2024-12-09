<template>
  <div class="forum-container">
    <!-- Campo de búsqueda -->
    <input v-model="searchQuery" type="text" placeholder="Buscar ofertes" class="search-input"/>

    <!-- Lista dinámica de anuncios -->
    <div class="ads-list">
      <div v-for="ad in filteredAds" :key="ad.id" class="ad-item">
        <h3 class="ad-title">{{ ad.titol }}</h3>       
        <p class="ad-description">{{ ad.contingut }}</p>
        <button @click="viewAdDetails(ad.id)">Veure més</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { getPublicaciones } from '../services/communicationManager.js'

const router = useRouter()
const searchQuery = ref('')
const ads = ref([]) // Aquí almacenaremos los datos de la API

// Computed para realizar la búsqueda en la lista de anuncios
const filteredAds = computed(() => {
  return ads.value.filter(ad => ad.titol.toLowerCase().includes(searchQuery.value.toLowerCase()))
})

// Función para navegar a una vista de detalles
const viewAdDetails = (id) => {
  router.push(`/ad/${id}`)
}

// Función para cargar los datos de las publicaciones
const fetchPublicaciones = async () => {
  ads.value = await getPublicaciones()
}

// Llamar a la API cuando el componente se monta
onMounted(() => {
  fetchPublicaciones()
})
</script>

<style scoped>
.forum-container {
  margin: 20px;
}

.search-input {
  padding: 10px;
  margin-bottom: 20px;
}

.ads-list {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.ad-item {
  border: 1px solid #ccc;
  padding: 10px;
  width: 250px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
}

.ad-title {
  font-size: 16px;
  font-weight: bold;
}

.ad-description {
  font-size: 14px;
}

button {
  margin-top: 10px;
  padding: 5px 10px;
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
