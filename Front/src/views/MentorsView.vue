<template>
  <div class="forum-container">
    <input v-model="searchQuery" type="text" placeholder="Buscar mentor" class="search-input" />
    <div class="ads-list">
      <div v-for="mentor in filtredMentors" :key="mentor.id" class="ad-item">
        <h3 class="ad-mentor">Nom i Cognoms: {{ mentor.nom }} {{ mentor.cognom }}</h3>
        <h4>Especialitat: {{ mentor.especialitat }}</h4>
        <h4>Curs: {{ mentor.curs }}</h4>
        <h4>Correu de contacte: {{ mentor.correu }}</h4>
      </div>
    </div>
  </div>
</template>
  
<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import { getMentors } from '../services/communicationManager.js'


const router = useRouter()
const searchQuery = ref('')
const mentor = ref([])
const fetchMentors = async () => {
  mentor.value = await getMentors()
}
const filtredMentors = computed(() => {
  return mentor.value.filter(mentor =>
    mentor.nom.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})
const displayedMentors = computed(() => {
  return filtredMentors.value.slice(0, pageSize.value * currentPage.value)
})

const hasMoreMentors = computed(() => {
  return filtredMentors.value.length > displayedMentors.value.length
})


const viewAdDetails = (id) => {
  router.push(`/ad/${id}`)
}
onMounted(() => {
  fetchMentors()
})
</script>
  