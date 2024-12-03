<template>
  <div class="landing-container">
    <button @click="goToForum">IR AL FORO</button>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const goToForum = () => {
  console.log('Navegando al foro...');
  router.push('/forum')  
}

</script>
