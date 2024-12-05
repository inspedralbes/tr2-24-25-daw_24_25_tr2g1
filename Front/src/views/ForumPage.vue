<template>
  <div class="forum-container">
    <input v-model="searchQuery" type="text" placeholder="Buscar anuncis" class="search-input"/>
    <div class="ads-list">
      <!-- Mostrar un mensaje si no hay publicaciones -->
      <p v-if="filteredAds.length === 0">No hi ha cap publicació.</p>

      <!-- Mostrar publicaciones -->
      <div v-for="ad in filteredAds" :key="ad.id" class="ad-item">
        <h3 class="ad-title">{{ publicacions.titol }}</h3>
        <p class="ad-description">{{ publicacions.contingut }}</p>
        <p class="ad-description">{{ publicacions.estat }}</p>
        <button @click="viewAdDetails(ad.id)">Ver más</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';  
import { useRouter } from 'vue-router';
import { getPublicacions } from '@/CommunicationManager';

// Referencias reactivas
const ads = ref([]);
const searchQuery = ref('');
const router = useRouter();

// Función para filtrar anuncios según la búsqueda
const filteredAds = computed(() => {
  return ads.value.filter(ad =>
    ad.titol.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

// Cargar las publicaciones desde la API al montar el componente
const loadPublications = async () => {
  try {
    ads.value = await getPublicacions();
  } catch (error) {
    console.error('Error al cargar publicaciones:', error);
  }
};

// Llama a la función de carga cuando el componente se monte
onMounted(() => {
  loadPublications();
});

// Navegar al detalle de un anuncio
const viewAdDetails = (id) => {
  router.push(`/ad/${id}`);
};
</script>