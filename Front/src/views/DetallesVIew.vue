<template>
  <div class="ad-details">
    <h2>{{ adDetails.title }}</h2>
    <p>{{ adDetails.description }}</p>
    <button @click="signUp">Apuntarse</button>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const adDetails = ref({})

onMounted(() => {
  adDetails.value = {
    title: 'Clase de Matemáticas',
    description: 'Clase particular de matemáticas para estudiantes de secundaria.'
  }
})

const signUp = () => {
  router.push('/auth')
}
</script>
