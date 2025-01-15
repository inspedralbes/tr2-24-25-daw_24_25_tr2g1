<template>
  <div class="ad-details">
    <h2 class="detalles-title">{{ adDetails.titol }}</h2>
    <p class="detalles-description">{{ adDetails.contingut }}</p>
    <p class="detalles-description"><strong>Mentor:</strong>  Pendent d'assignar</p>
    <p class="detalles-description"><strong>Especialitat:</strong> {{ adDetails.especialitat }}</p>
    <p class="detalles-description"><strong>Dia:</strong> {{ adDetails.data_publicacio }}</p>
    <p class="detalles-description"><strong>Horari:</strong> {{ adDetails.hora_inici }}h - {{ adDetails.hora_final }}h</p>

    <!-- Dialog de confirmació -->
    <div v-if="showConfirmDialog" class="confirmation-dialog">
      <div class="dialog-content">
        <h3>Confirmació de la reserva</h3>
        <p  class="detalles-description">Especialitat: {{ adDetails.especialitat }}</p>
        <p  class="detalles-description">Data: {{ adDetails.data_publicacio }}</p>
        <p  class="detalles-description">Horari: {{ adDetails.hora_inici }}h - {{ adDetails.hora_final }}h</p>
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
import Swal from 'sweetalert2'

const route = useRoute()
const router = useRouter()
const adDetails = ref({})
const showConfirmDialog = ref(false)
const userID = ref(localStorage.getItem('userId'));

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
  console.log('authStore.userId:', userID.value);
  try {
    const response = await registerForClass(
      adDetails.value.id,
      userID.value,
      adDetails.value.id_usuari
    );

    if (response.success) {
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'T\'has inscrit correctament a la classe!, Rebràs un correu de confirmació.',
        showConfirmButton: false,
        timer: 2500,
      })

      setTimeout(() => {
        router.push('/forum');
      }, 2500);

      showConfirmDialog.value = false;
    } else {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Hi ha hagut un error en la inscripció. Torna-ho a provar més tard.',
        showConfirmButton: false,
        timer: 2500,
      })
    }
  } catch (error) {
    console.error('Error en la inscripció:', error);
    Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'Hi ha hagut un error en la inscripció. Torna-ho a provar més tard.',
      showConfirmButton: false,
      timer: 2500,
    })

  }
};
</script>

<style scoped>
.ad-details {
  margin: auto;
  padding: 25px;
  background-color: #f9f9fa;
  border-radius: 12px;
  border: 1px solid #e1e4e8;
}

.detalles-title {
  color: #000000;
  font-size: 22px;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid #000000;
}

.detalles-description {
  color: #4a4a4a;
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 8px;
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
