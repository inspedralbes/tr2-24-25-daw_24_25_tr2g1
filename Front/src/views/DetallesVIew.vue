<template>
  <div class="ad-details">
    <h2>{{ adDetails.titol }}</h2>
    <p>{{ adDetails.contingut }}</p>
    <p>Mentor: Pendent d'assignar</p>
    <p>Especialitat: {{ adDetails.especialitat }}</p>
    <p>Dia: {{ adDetails.data_publicacio }}</p>
    <p>Horari: {{ adDetails.hora_inici }}h - {{ adDetails.hora_final }}h</p>

    <!-- Dialog de confirmació -->
    <div v-if="showConfirmDialog" class="confirmation-dialog">
      <div class="dialog-content">
        <h3>Confirmació de la reserva</h3>
        <p>Especialitat: {{ adDetails.especialitat }}</p>
        <p>Data: {{ adDetails.data_publicacio }}</p>
        <p>Horari: {{ adDetails.hora_inici }}h - {{ adDetails.hora_final }}h</p>
        <div class="dialog-buttons">
          <button @click="confirmSignUp">Confirmar</button>
          <button @click="showConfirmDialog = false">Cancel·lar</button>
        </div>
      </div>
    </div>

    <div v-if="isAuthenticated">
      <button @click="showSignUpDialog">Inscriure'm</button>
    </div>
    <div v-else>
      <p>Per inscriure't a aquesta classe, has de <router-link to="/login">iniciar sessió</router-link>.</p>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { getAdDetails, registerForClass } from '../services/communicationManager.js'
import { useAuthStore } from '../stores/authStore.js'

const route = useRoute()
const router = useRouter()
const adDetails = ref({})
const showConfirmDialog = ref(false)

// Obtenir les dades de l'oferta
onMounted(async () => {
  const adId = route.params.id
  adDetails.value = await getAdDetails(adId)
})

// Comprovem si l'usuari està autenticat
const authStore = useAuthStore()
const isAuthenticated = computed(() => authStore.isAuthenticated)

// Mostrar diàleg de confirmació
const showSignUpDialog = () => {
  if (isAuthenticated.value) {
    showConfirmDialog.value = true
  } else {
    router.push('/login')
  }
}

// Confirmar inscripció
const confirmSignUp = async () => {
  try {
    const response = await registerForClass(
      adDetails.value.id, // The publication/class ID
      authStore.userId,   // The student ID (logged in user)
      adDetails.value.id_usuari // The mentor ID (from publication)
    );

    if (response.success) {
      alert('T\'has inscrit correctament a la classe! Rebràs un correu de confirmació.');
      showConfirmDialog.value = false;
    } else {
      alert(response.message || 'Hi ha hagut un error en la inscripció. Torna-ho a provar més tard.');
    }
  } catch (error) {
    console.error('Error en la inscripció:', error);
    alert('Hi ha hagut un error en la inscripció. Torna-ho a provar més tard.');
  }
};
</script>

<style scoped>
.ad-details {
  width: 800px;
  height: 375px;
  margin: 30px auto;
  padding: 25px;
  background-color: #f9f9fa;
  border-radius: 12px;
  border: 1px solid #e1e4e8;
}

h2 {
  color: #000000;
  font-size: 22px;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid #000000;
}

p {
  color: #4a4a4a;
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 25px;
}

button {
  padding: 10px 20px;
  background-color: #000000;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-size: 16px;
}

button:hover {
  background-color: lightgrey;
  color: black;
}


.confirmation-dialog {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.dialog-content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  max-width: 400px;
}

.dialog-buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

button {
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
}
</style>
