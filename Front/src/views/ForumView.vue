<template>
  <div class="forum-container">
    <input v-model="searchQuery" type="text" placeholder="Buscar anuncios" class="search-input"/>
    <div class="ads-list">
      <div v-for="ad in filteredAds" :key="ad.id" class="ad-item">
        <h3 class="ad-title">{{ ad.title }}</h3>
        <p class="ad-description">{{ ad.description }}</p>
        <button @click="viewAdDetails(ad.id)">Ver más</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';  
import { useRouter } from 'vue-router'

const router = useRouter()
const searchQuery = ref('')

//ejemplo 
const ads = ref([
  { id: 1, title: 'Clase de Matemáticas', description: 'Clases particulares de matemáticas.' },
  { id: 2, title: 'Clase de Inglés', description: 'Clases particulares de inglés para todos los niveles.' },
  { id: 3, title: 'Clase de Inglés', description: 'Clases particulares de inglés para todos los niveles.' },
  { id: 4, title: 'Clase de Inglés', description: 'Clases particulares de inglés para todos los niveles.' },
])

const filteredAds = computed(() => {
  return ads.value.filter(ad => ad.title.toLowerCase().includes(searchQuery.value.toLowerCase()))
})

const viewAdDetails = (id) => {
  router.push(`/ad/${id}`)
}
</script>
