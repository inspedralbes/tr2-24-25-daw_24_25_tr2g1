<template>
  <div class="forum-container">
    <!-- Entrada de cerca -->
    <div class="filters">
      <label for="especialitat">Especialitat:</label>
      <select id="especialitat" v-model="selectedEspecialitat">
        <option value="">Totes</option>
        <option v-for="especialitat in uniqueEspecialitats" :key="especialitat" :value="especialitat">{{ especialitat }}</option>
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

      <button class="search-button" @click="searchOffers">Buscar</button>
    </div>

    <!-- Llista d'anuncis dinàmica -->
    <div class="ads-list">
      <div v-for="ad in displayedAds" :key="ad.id" class="ad-item">
        <h3 class="ad-title">{{ ad.titol }}</h3>
        <p class="ad-description">{{ ad.contingut }}</p>
        <p class="ad-details">
          <!-- <span>Especialitat: {{ ad.especialitat }}</span>
          <span>Hora Inici: {{ ad.hora_inici }}</span>
          <span>Hora Final: {{ ad.hora_final }}</span>
          <span>Dia: {{ ad.dia }}</span> -->
        </p>
        <button class="button" @click="viewAdDetails(ad.id)">Veure més</button>
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

const selectedEspecialitat = ref('')
const selectedHoraInici = ref('')
const selectedDia = ref('')

// Funcion per extraer especialitats uniques
const extractUniqueEspecialitats = () => {
  const allEspecialitats = ads.value.map(ad => ad.especialitat).filter(Boolean)
  uniqueEspecialitats.value = [...new Set(allEspecialitats)].sort()
}

// Funcion per extraer horas uniques
const extractUniqueHours = () => {

  const allHoraInici  = ads.value.map(ab => ab.hora_inici).filter(Boolean)
  uniqueHoraInici.value = [...new Set(allHoraInici)].sort()
}

// Funcion per extraer dies uniques
const extractUniqueDays = () => {
  const allDies = ads.value.map(ad => ad.dia).filter(Boolean)
  uniqueDies.value = [...new Set(allDies)].sort()
}

// Computat per cercar a la llista d'anuncis
const filteredAds = computed(() => {

  return ads.value.filter((ad) => {
    const matchEspecialitat = !selectedEspecialitat.value || ad.especialitat === selectedEspecialitat.value
    const matchHoraInici = !selectedHoraInici.value || (ad.hora_inici && ad.hora_inici.startsWith(selectedHoraInici.value))
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

<style scoped>
.forum-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  background-color: lightgrey;
  border-radius: 2%;
}

/* Estilo de los filtros */
.filters {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  gap: 10px;
  background-color: #f8f9fa;
  padding: 15px;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  margin-bottom: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.filters label {
  font-size: 16px;
  color: #333;
  margin-right: 10px;
}

.filters select {
  padding: 8px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 6px;
  background-color: #fff;
  transition: border-color 0.3s ease;
}

.filters select:focus {
  outline: none;
  border-color: #007bff;
}

.search-button {
  padding: 10px 20px;
  background-color: black;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.search-button:hover {
  background-color: lightgray;
  color: black;
  transform: scale(1.05);
}

/* Estilo de la lista de anuncios */
.ads-list {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}

.ad-item {
  height: 85%;
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
  box-shadow: 0 10px 20px black;
}

.ad-title {
  font-size: 18px;
  font-weight: 700;
  color: #333;
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

.button {
  align-self: center;
  padding: 8px 15px;
  background-color: black;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: rgb(169, 169, 169);
  color: black;
}

.load-more-container {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.load-more-button {
  padding: 10px 20px;
  background-color: black;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.load-more-button:hover {
  background-color: rgb(169, 169, 169);
  color: black;
}
</style>
