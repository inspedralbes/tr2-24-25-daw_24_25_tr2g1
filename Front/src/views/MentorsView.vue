<template>
  <div class="forum-container">
    <!-- Entrada de cerca -->
    <input v-model="searchQuery" type="text" placeholder="Buscar mentor o especialitat" class="search-input" />
    
    <!-- Llista de mentors dinàmica -->
    <div class="ads-list">
      <div v-if="displayedMentors.length === 0" class="no-results">No s'ha trobat cap resultat amb aquesta cerca.</div>
      <div v-for="mentor in displayedMentors" :key="mentor.id" class="ad-item">
        <h3 class="ad-mentor">Nom i Cognoms: {{ mentor.nom }} {{ mentor.cognom }}</h3>
        <h4>Especialitat: {{ mentor.especialitat }}</h4>
        <h4>Curs: {{ mentor.curs }}</h4>
        <h4>Correu de contacte: {{ mentor.correu }}</h4>
      </div>
    </div>

    <!-- Botó Carregar més -->
    <div class="load-more-container" v-if="hasMoreMentors">
      <button class="load-more-button" @click="loadMoreMentors">
        Carregar més mentors
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import { getMentors } from '../services/communicationManager.js'

const router = useRouter()
const searchQuery = ref('')
const mentor = ref([])
const pageSize = ref(9)
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

// Funcio per obtenir els mentors
const fetchMentors = async () => {
  mentor.value = await getMentors()
}

// Funcio per fer la busqueda d'un mentor
const filtredMentors = computed(() => {
  return mentor.value.filter((mentor) => {
    const query = searchQuery.value.toLowerCase()
    return (
      mentor.nom.toLowerCase().includes(query) || mentor.especialitat.toLowerCase().includes(query) || mentor.cognom.toLowerCase().includes(query)
    )
  })
})

// Funcio per mostrar mentors paginats
const displayedMentors = computed(() => {
  return filtredMentors.value.slice(0, pageSize.value * currentPage.value)
})

// Funcio per comprovar si hi ha mentors per carregar
const hasMoreMentors = computed(() => {
  return filtredMentors.value.length > displayedMentors.value.length
})

// Funció per carregar més mentors
const loadMoreMentors = () => {
  currentPage.value += 1
}

onMounted(() => {
  fetchMentors()
})
</script>