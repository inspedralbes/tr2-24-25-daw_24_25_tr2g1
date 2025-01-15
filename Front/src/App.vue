<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useRouter } from 'vue-router'
import { ref, onMounted, computed } from 'vue'
import { useAuthStore } from './stores/authStore'
import GestionUsuarios from './views/GestionUsuarios.vue'

// Servidor Socket.IO
import { io } from 'socket.io-client'
//const socket = io('http://localhost:3000')
const socket = io('http://alumnet.daw.inspedralbes.cat:21333')
let userSocketId

let isNavBarClicked = ref(false)
const router = useRouter()
const authStore = useAuthStore()
const userId = computed(() => authStore.userId)
const GestionUsuariosRef = ref(null)

// Comprova si l'usuari està autenticat en carregar l'aplicació
onMounted(() => {
  authStore.checkAuth() // Esto carga el estado desde el store automáticamente
})

// Comprova si l'usuari està autenticat
const isAuthenticated = computed(() => authStore.isAuthenticated)

// Verificar el rol de l'usuari de manera reactiva
const userRole = computed(() => authStore.rol)

// Verificar el nom d'usuari
const userName = computed(() => authStore.username || 'Anónimo')

// Función para verificar si el usuario puede publicar una oferta
const canPublishOffer = computed(() => {
  return userRole.value === 'mentor' || userRole.value === 'professor'
})

// Función para abrir la ventana de gestión de usuarios
const openUsersManagement = () => {
  if (userRole.value === 'professor') {
    GestionUsuariosRef.value?.togglePopup()
  }
}

// Funció per gestionar el logout
const handleLogout = () => {
  authStore.logout()
  router.push('/').then(() => {
    window.location.reload()
  })
}

let chatIsOpen = ref(false)
let messages = ref([])
let input = ref('')

const openChat = () => {
  chatIsOpen.value = true
}

const closeChat = () => {
  chatIsOpen.value = false
}

// Conectar a Socket.IO
socket.on('connect', () => {
  console.log('Conectado al servidor de chat')
  userSocketId = socket.id
  console.log('ID de usuario:', userSocketId)
  console.log('Username:', userName.value)

  // Escuchar mensajes entrantes
  socket.on('receive-message', (message) => {
    // console.log("Mensaje recibido:", message);
    messages.value.push(message)
  })
})

// Enviar un mensaje al servidor
function sendMessage() {
  if (input.value !== '') {
    // const message = { autor: socket.id, mensaje: input.value }
    const message = { autor: userName.value, socketId: userSocketId, mensaje: input.value }
    socket.emit('send-message', message)
    input.value = ''
    console.log(userName.value, message)
  }
}
</script>

<template>
  <div class="contenidoBody">
    <nav id="navDesktop">
      <div class="logo" @click="(router.push('/'), (isNavBarClicked = false))">AlumNet</div>
      <div v-if="isAuthenticated" class="auth-container">
        <p class="nav-username" v-if="userRole !== 'professor'">{{ userName }}</p>
        <br />
        <p class="nav-role">{{ userRole }}</p>
        <img
          v-if="userRole === 'professor'"
          src="/src/assets/icons/lista.png"
          alt="Gestió d'usuaris"
          @click="openUsersManagement"
          class="nav-icon"
        />
        <button @click="handleLogout" class="nav-button">
          <img src="/src/assets/icons/out.svg" alt="LogOut" width="25px" />
        </button>
      </div>
      <div v-else>
        <RouterLink to="/login" @click="isNavBarClicked = true"
          ><img src="/src/assets/icons/user.svg" alt="Login" width="25px"
        /></RouterLink>
      </div>
    </nav>
    <GestionUsuarios ref="GestionUsuariosRef" />
    <div class="description" v-if="!isNavBarClicked">
      <p>ORGANITZA EL TEU APRENENTATGE I CONNECTA AMB COMPANYS D’ESTUDIS!</p>
      <div class="scroll-container">
        <p>
          Descobreix una plataforma on gestionar dades acadèmiques i trobar classes particulars amb
          altres alumnes.
        </p>
      </div>
    </div>

    <div class="scroll-container-mobile" v-if="isNavBarClicked">
      <p>
        Descobreix una plataforma on gestionar dades acadèmiques i trobar classes particulars amb
        altres alumnes.
      </p>
    </div>

    <!-- Desktop View -->
    <div class="landing-nav">
      <RouterLink to="/forum" @click="isNavBarClicked = true" class="button">FORO</RouterLink>
      <RouterLink to="/profiles" @click="isNavBarClicked = true" class="button">MENTORS</RouterLink>
      <RouterLink to="/jobs" @click="isNavBarClicked = true" class="button"
        >BUSCAR OFERTES</RouterLink
      >
      <RouterLink to="/publish" @click="isNavBarClicked = true" class="button"
        >PUBLICAR OFERTA</RouterLink
      >
      <RouterLink to="/aboutUs" @click="isNavBarClicked = true" class="button"
        >SOBRE NOSALTRES</RouterLink
      >
      <RouterLink to="/contact" @click="isNavBarClicked = true" class="button">CONTACTE</RouterLink>
    </div>

    <!-- Mobile View -->
    <div class="landing-nav-mobile">
      <RouterLink to="/forum" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/foro.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/profiles" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/mentor.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/jobs" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/buscar.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/publish" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/publicar.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/aboutUs" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/sobrenosaltres.png" width="25vh"
      /></RouterLink>
      <RouterLink to="/contact" @click="isNavBarClicked = true" class="button"
        ><img src="/src/assets/icons/contacte.png" width="25vh"
      /></RouterLink>
    </div>

    <!-- Contingut per la pàgina -->
    <div class="container">
      <RouterView />
    </div>

    <!-- Chat Button -->
    <div class="chat-button" @click="openChat" v-if="!chatIsOpen">
      <img src="/src/assets/icons/chat.svg" alt="Chat" width="80px" />
    </div>

    <!-- Chat Container -->
    <div class="chat-container" v-if="chatIsOpen">
      <div class="chat-header">
        <p class="chat-title">AlumNet | Chat</p>
        <img src="/src/assets/icons/close.svg" alt="" class="close-button" @click="closeChat" />
      </div>
      <div class="chat-body">
        <ul id="messages">
          <p class="chat-subtitle">AlumNet</p>
          <li
            v-for="(message, index) in messages"
            :key="index"
            :class="{
              'my-message': message.autor === userName.value || message.socketId === userSocketId,
              'other-message':
                message.autor !== userName.value && message.socketId !== userSocketId,
            }"
          >
            <!-- {{ message.mensaje }} -->
            <p class="message-autor" v-if="message.socketId !== userSocketId">{{ message.autor }}</p>
            <p class="message-text">{{ message.mensaje }}</p>
          </li>
        </ul>
      </div>
      <form @submit.prevent="sendMessage" class="message-form">
        <input v-model="input" placeholder="Mensaje" class="message-input" />
        <button type="submit" class="message-button">Envia</button>
      </form>
    </div>

    <footer>
      <p>© 2024 AlumNet. Tots els drets reservats.</p>
    </footer>
  </div>
</template>

<style scoped>
</style>
