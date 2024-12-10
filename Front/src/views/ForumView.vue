<template>
  <div class="forum-container">
    <!-- Campo de búsqueda -->
    <input v-model="searchQuery" type="text" placeholder="Buscar ofertes" class="search-input" />

    <!-- Lista dinámica de anuncios -->
    <div class="ads-list">
      <div v-for="ad in filteredAds" :key="ad.id" class="ad-item">
        <h3 class="ad-title">{{ ad.titol }}</h3>
        <p class="ad-description">{{ ad.contingut }}</p>
        <button class="button" @click="viewAdDetails(ad.id)">Veure més</button>
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
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f4f4f6;
}

.search-input {
  width: 100%;
  padding: 12px;
  margin: 30px;
  border: 2px solid #e0e0e0;
  border-radius: 8px;
  font-size: 16px;
  transition: border-color 0.5s ease;
  margin-left: -5px;
}

.search-input:focus {
  outline: none;
  border-color: #007bff;
}

.ads-list {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}

.ad-item {
  height: 80%;
  width: 90%;
  background-color: white;
  border-radius: 10px;
  padding: 20px;
  margin: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.ad-item:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px #283848;


}

.ad-title {
  font-size: 18px;
  font-weight: 700;
  color: #333;
  /* text-align: center; */
  margin-bottom: 10px;
}

.ad-description {
  font-size: 14px;
  color: #666;
  margin-bottom: 15px;
  flex-grow: 1;
  overflow: hidden;
  text-overflow: ellipsis;

}

button {
  align-self: center;
  padding: 8px 15px;
  background-color: rgb(169, 169, 169);
  color: black;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;

}

button:hover {
  background-color:  #021931;
  color: white;
}
</style>
