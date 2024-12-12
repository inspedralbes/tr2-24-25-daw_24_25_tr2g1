   <template>
    <div class="forum-container">
      <!-- Entrada de cerca -->
      <div class="filters">
            <label for="especialitat">Especialitat:</label>
            <select id="especialitat" v-model="selectedEspecialitat">
                <option value="">Totes</option>
                <option value="Matemáticas">Matemáticas</option>
                <option value="Inglés">Inglés</option>
                <option value="Ciencias">Ciencias</option>
                <option value="Ciencias Sociales">Ciencias Sociales</option>
                <option value="Ciencias Naturales">Ciencias Naturales</option>
            </select>
            <label for="hora">Hora:</label>
            <select id="hora" v-model="selectedHora">
                <option value="">Totes</option>
                <option value="">8:00</option>
                <option value="">8:30</option>
                <option value="">9:00</option>
                <option value="">9:30</option>
                <option value="">10:00</option>
                <option value="">10:30</option>
                <option value="">11:00</option>
                <option value="">11:30</option>
                <option value="">12:00</option>
                <option value="">12:30</option>
                <option value="">13:00</option>
                <option value="">13:30</option>
                <option value="">14:00</option>
            </select>
            <label for="dia">Dia:</label>
            <select id="dia" v-model="selectedDia">
                <option value="">Totes</option>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miercoles">Miercoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
            </select>
        </div>
  
      <!-- Llista d'anuncis dinàmica -->
      <div class="ads-list">
        <div v-for="ad in displayedAds" :key="ad.id" class="ad-item">
          <h3 class="ad-title">{{ ad.titol }}</h3>
          <p class="ad-description">{{ ad.contingut }}</p>
          <button class="button" @click="viewAdDetails(ad.id)">Veure més</button>
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
  
  // Funció per obtenir publicacions
  const fetchPublicaciones = async () => {
    ads.value = await getPublicaciones()
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
    background-color:  black;
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
  