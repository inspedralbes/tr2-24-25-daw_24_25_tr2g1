<template>
    <div class="forum-container">
        <input v-model="searchQuery" type="text" placeholder="Buscar mentor" class="search-input"/>
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
  