<template>
  <div class="forum-container">
    <!-- Entrada de cerca -->
    <input v-model="searchQuery" type="text" placeholder="Buscar ofertes" class="search-input" />

    <!-- Llista d'anuncis dinàmica -->
    <div class="ads-list">
      <div v-if="displayedAds.length === 0" class="no-results">No s'ha trobat cap resultat amb aquesta cerca.</div>
      <div v-for="ad in displayedAds" :key="ad.id" class="ad-item">
        <h3 class="ad-title">{{ ad.titol }}</h3>
        <p class="ad-description">{{ ad.contingut }}</p>
        <button class="buttonDetails" @click="viewAdDetails(ad.id)">Veure més</button>
      </div>
    </div>

    <!-- Botó Carregar més -->
    <div class="load-more-container" v-if="hasMoreAds">
      <button class="load-more-button" @click="loadMoreAds">
        Carregar més publicacions
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { getPublicaciones } from '../services/communicationManager.js'

const router = useRouter()
const searchQuery = ref('')
const ads = ref([])
const pageSize = ref(9) // Nombre d'anuncis a mostrar inicialment i en cada càrrega
const currentPage = ref(1)

// Comprovar si el dispositiu es móbil
const mediaQuery = window.matchMedia("(max-width: 768px)");

function handleMediaQueryChange(event) {
  if (event.matches) {
    // Si la media query se cumple
    pageSize.value = 4;
    // document.getElementById("message").textContent = "Tamaño de pantalla: Pequeño";
  } else {
    // Si la media query NO se cumple
    pageSize.value = 9;
    // document.getElementById("message").textContent = "Tamaño de pantalla: Normal";
  }

  console.log("Variable actualizada:", pageSize.value);
}

// Escuchar cambios en la media query
mediaQuery.addEventListener("change", handleMediaQueryChange);

// Ejecutar la función al cargar la página para comprobar el estado inicial
handleMediaQueryChange(mediaQuery);

// Funció per obtenir publicacions
const fetchPublicaciones = async () => {
  ads.value = await getPublicaciones()
}

// Computat per cercar a la llista d'anuncis
const filteredAds = computed(() => {
  return ads.value.filter(ad =>
    ad.titol.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

// Computat per mostrar anuncis paginats i filtrats
const displayedAds = computed(() => {
  return filteredAds.value.slice(0, pageSize.value * currentPage.value)
})

// Comprovar si hi ha més anuncis per carregar
const hasMoreAds = computed(() => {
  return filteredAds.value.length > displayedAds.value.length
})

// Funció per navegar als detalls de l'anunci
const viewAdDetails = (id) => {
  router.push(`/ad/${id}`)
}

// Funció per carregar més anuncis
const loadMoreAds = () => {
  currentPage.value += 1
}

// Obtenir publicacions quan el component es munta
onMounted(() => {
  fetchPublicaciones()
})
</script>