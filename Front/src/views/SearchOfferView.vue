<template>
  <div class="forum-container">
    <!-- Entrada de cerca -->

    <div class="filters">
      <label for="especialitat">Especialitat:</label>
      <select id="especialitat" v-model="selectedEspecialitat">
        <option value="">Totes</option>
        <option
          v-for="especialitat in uniqueEspecialitats"
          :key="especialitat"
          :value="especialitat"
        >
          {{ especialitat }}
        </option>
      </select>

      <label for="hora">Hora:</label>
      <select id="hora" v-model="selectedHoraInici">
        <option value="">Totes</option>
        <option v-for="hour in uniqueHoraInici" :key="hour" :value="hour">{{ hour }}</option>
      </select>

      <label for="dia">Dia:</label>
      <select id="dia" v-model="selectedDia">
        <option value="">Totes</option>
        <option v-for="day in uniqueDies" :key="day" :value="day">{{ day }}</option>
      </select>
    </div>

    <!-- Filtro de cerca mobile -->

    <div class="filters-mobile">
      <select id="especialitat" v-model="selectedEspecialitat">
        <option value="">Especialitat</option>
        <option
          v-for="especialitat in uniqueEspecialitats"
          :key="especialitat"
          :value="especialitat"
        >
          {{ especialitat }}
        </option>
      </select>

      <select id="hora" v-model="selectedHoraInici">
        <option value="">Hora</option>
        <option v-for="hour in uniqueHoraInici" :key="hour" :value="hour">{{ hour }}</option>
      </select>

      <select id="dia" v-model="selectedDia">
        <option value="">Dia</option>
        <option v-for="day in uniqueDies" :key="day" :value="day">{{ day }}</option>
      </select>
    </div>

    <!-- Llista d'anuncis dinàmica -->
    <div class="ads-list">
      <div v-if="displayedAds.length === 0" class="no-results">No s'ha trobat cap resultat amb aquesta cerca.</div>
      <div v-for="ad in displayedAds" :key="ad.id" class="ad-item">
        <h3 class="ad-title">{{ ad.titol }}</h3>
        <p class="ad-description">{{ ad.contingut }}</p>
        <p class="ad-details">
          <!-- <span>Especialitat: {{ ad.especialitat }}</span>
          <span>Hora Inici: {{ ad.hora_inici }}</span>
          <span>Hora Final: {{ ad.hora_final }}</span>
          <span>Dia: {{ ad.dia }}</span> -->
        </p>
        <button class="buttonDetails" @click="viewAdDetails(ad.id)">Veure més</button>
      </div>
    </div>

    <div class="load-more-container" v-if="hasMoreAds">
      <button class="load-more-button" @click="loadMoreAds">Carregar més publicacions</button>
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
const uniqueEspecialitats = ref([])
const uniqueHoraInici = ref([])
const uniqueDies = ref([])
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

const selectedEspecialitat = ref('')
const selectedHoraInici = ref('')
const selectedDia = ref('')

// Funcion per extraer especialitats uniques
const extractUniqueEspecialitats = () => {
  const allEspecialitats = ads.value.map((ad) => ad.especialitat).filter(Boolean)
  uniqueEspecialitats.value = [...new Set(allEspecialitats)].sort()
}

// Funcion per extraer horas uniques
const extractUniqueHours = () => {
  const allHoraInici = ads.value.map((ab) => ab.hora_inici).filter(Boolean)
  uniqueHoraInici.value = [...new Set(allHoraInici)].sort()
}

// Funcion per extraer dies uniques
const extractUniqueDays = () => {
  const allDies = ads.value.map((ad) => ad.dia).filter(Boolean)
  uniqueDies.value = [...new Set(allDies)].sort()
}

// Computat per cercar a la llista d'anuncis
const filteredAds = computed(() => {
  return ads.value.filter((ad) => {
    const matchEspecialitat =
      !selectedEspecialitat.value || ad.especialitat === selectedEspecialitat.value
    const matchHoraInici =
      !selectedHoraInici.value ||
      (ad.hora_inici && ad.hora_inici.startsWith(selectedHoraInici.value))
    const matchDia = !selectedDia.value || ad.dia === selectedDia.value

    return matchEspecialitat && matchHoraInici && matchDia
  })
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

// Funció per obtenir publicacions
const fetchPublicaciones = async () => {
  ads.value = await getPublicaciones()
  extractUniqueEspecialitats()
  extractUniqueHours()
  extractUniqueDays()
}

// Obtenir publicacions quan el component es munta
onMounted(() => {
  fetchPublicaciones()
})
</script>
