<template>
  <div class="auth-container">
    <h2>Iniciar sesión / Registrarse</h2>
    <div class="form-container">
      <button @click="showLogin = !showLogin">Iniciar sesión</button>
      <button @click="showLogin = !showLogin">Registrarse</button>

      <div v-if="showLogin">
        <form @submit.prevent="handleLogin">
          <input type="text" placeholder="Usuario" v-model="username" />
          <input type="password" placeholder="Contraseña" v-model="password" />
          <button type="submit">Iniciar sesión</button>
        </form>
      </div>

      <div v-else>
        <form @submit.prevent="handleRegister">
          <input type="text" placeholder="Usuario" v-model="username" />
          <input type="password" placeholder="Contraseña" v-model="password" />
          <button type="submit">Registrarse</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const showLogin = ref(true)
const username = ref('')
const password = ref('')

const handleLogin = () => {
  console.log('Iniciar sesión con', username.value, password.value)
}

const handleRegister = () => {
  console.log('Registrarse con', username.value, password.value)
}
</script>