<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useRouter } from 'vue-router'
import { ref } from 'vue'
// Servidor Socket.IO
import { io } from 'socket.io-client'
const socket = io('http://localhost:3000')
let userSocketId

let isNavBarClicked = ref(false)
const router = useRouter()

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
  
  // Escuchar mensajes entrantes
  socket.on('receive-message', (message) => {
    // console.log("Mensaje recibido:", message);
    messages.value.push(message)
  })
})

// Enviar un mensaje al servidor
function sendMessage() {
  if (input.value !== '') {
    const message = { autor: socket.id, mensaje: input.value };
    socket.emit('send-message', message)
    input.value = '';
    console.log(socket.id, message);
  }
}
</script>

<template>
  <div class="contenidoBody">
    <nav id="navDesktop">
      <div class="logo" @click="(router.push('/'), (isNavBarClicked = false))">AlumNet</div>
      <div>
        <!-- <li><RouterLink to="/experience">Classes</RouterLink></li> -->
        <RouterLink to="/login" @click="isNavBarClicked = true"
          ><img src="/src/assets/icons/user.svg" alt="Login" width="25px"
        /></RouterLink>
      </div>
    </nav>
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
          <li v-for="(message, index) in messages" :key="index" :class="{'my-message': message.autor === userSocketId, 'other-message': message.autor !== userSocketId}">
            <!-- {{ message.mensaje }} -->
            <p class="message-autor" v-if="message.autor !== userSocketId">{{ message.autor }}</p>
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
.button:hover {
  background-color: rgb(169, 169, 169);
  color: black;
}

.chat-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  transition: 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.chat-button:hover {
  transform: scale(0.9);
}

.chat-container {
  position: fixed;
  bottom: 10vh;
  right: 2vh;
  width: 40vh;
  height: 60vh;
  background-color: #eaeaea;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: 0.3s ease;
}

.chat-header {
  display: flex;
  background-color: black;
  border-bottom: 1px solid #ccc;
}

.chat-title {
  color: white;
  margin: 1vh;
  padding: 1vh;
}

.chat-subtitle {
  font-weight: bold;
  text-align: center;
  color: rgba(0, 0, 0, 0.245);
  border-bottom: 1px solid #ccc;
}

.close-button {
  position: absolute;
  right: 0;
  width: 10%;
  margin: 1vh;
  cursor: pointer;
}

.message-form {
  padding: 1vh;
  display: flex;
  gap: 1vh;
}

.message-input {
  padding: 8px;
  font-size: 16px;
  width: 80%;
}

.message-button {
  font-size: 16px;
  cursor: pointer;
  width: 20%;
  border: 2px solid rgb(0, 198, 0);
  background-color: rgb(133, 255, 133);
}

.chat-body {
  height: 80%;
  overflow-y: auto;
  margin: 1vh;
  padding: 1vh;
  background-color: white;
  font-size: 16px;
  display: flex;
  flex-direction: column-reverse;
}

#messages {
  position: relative;
  list-style-type: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 1.3vh;
}

#messages > li {
  max-width: 80%;
  color: #333;
  word-wrap: break-word;
}

.my-message {
  margin-left: auto;
  text-align: right;
}

.my-message .message-text {
  background-color: #4faaff;
}

.message-autor {
  font-weight: bold;
  font-size: .75rem;
}

.message-text {
  display: inline-block;
  max-width: 100%;
  border-radius: 4vw;
  padding: 1.2vh;
  font-size: small;
}

.other-message {
  margin-right: auto;
  text-align: left;
}

.other-message .message-text {
  background-color: #989898;
}
</style>

<!-- Canvi proba -->