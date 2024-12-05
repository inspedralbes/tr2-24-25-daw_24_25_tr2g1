<template>
    <div class="forum-container">
        <div class="filters">
            <label for="mentor">Mentor:</label>
            <input type="text" id="mentor" v-model="searchMentor" placeholder="Pepe">
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
                <option value="Sabado">Sabado</option>
            </select>
        </div>

        <div class="ads-list">
            <div v-for="ad in filteredAds" :key="ad.id" class="ad-item">
                <h4>{{ ad.especialitat }}</h4>
            <h3 class="ad-mentor">{{ ad.mentor }}</h3>
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
    { id: 1, mentor: 'nomMentor', especialitat: 'Matemáticas', description: 'Lorem ipsum dolor sit amet' },
    { id: 2, mentor: 'nomMentor', especialitat: 'Matemáticas', description: 'Lorem ipsum dolor sit amet' },
    { id: 3, mentor: 'nomMentor', especialitat: 'Matemáticas', description: 'Lorem ipsum dolor sit amet' },
    { id: 4, mentor: 'nomMentor', especialitat: 'Matemáticas', description: 'Lorem ipsum dolor sit amet' },
  ])
  
  const filteredAds = computed(() => {
    return ads.value.filter(ad => ad.mentor.toLowerCase().includes(searchQuery.value.toLowerCase()))
  })
  
  const viewAdDetails = (id) => {
    router.push(`/ad/${id}`)
  }
  </script>
  