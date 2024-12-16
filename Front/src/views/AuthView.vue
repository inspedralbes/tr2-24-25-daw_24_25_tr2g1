<template>
  <div class="auth-container">
    <h2>Iniciar sesión / Registrarse</h2>
    <div class="form-container">
      <button @click="showLogin = !showLogin">Iniciar sesión</button>
      <button @click="showLogin = !showLogin">Registrarse</button>

      <div v-if="showLogin">
        <form @submit.prevent="handleLogin">
          <input type="text" placeholder="Usuario" v-model="username" /><br>
          <input type="password" placeholder="Contraseña" v-model="password" /><br>
          <br><button type="submit">Iniciar sesión</button>
        </form>
      </div>

      <div v-else>
        <form @submit.prevent="handleRegister">
          <input type="text" placeholder="Usuario" v-model="username" required /><br>
          <input type="password" placeholder="Contraseña" v-model="password" required /><br>
          <input type="text" placeholder="Nombre" v-model="nombre" required /><br>
          <input type="text" placeholder="Apellidos" v-model="apellidos" required /><br>
          <select name="curso" id="curso">
            <option value="Curso">1º ESO</option>
            <option value="Curso">2º ESO</option>
            <option value="Curso">3º ESO</option>
            <option value="Curso">4º ESO</option>
            <option value="Curso">1º BTX</option>
            <option value="Curso">2º BTX</option>
          </select><br>
          <input type="text" placeholder="Clase" v-model="clase" required /><br>
          <input type="mail" placeholder="Mail" v-model="mail" required /><br>
          <input type="text" placeholder="DNI" v-model="dni" required /><br>

          <br><button type="submit">Registrarse</button>
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
const nombre = ref('')
const apellidos = ref('')
const curso = ref('')
const clase = ref('')
const mail = ref('')
const dni = ref('')


const handleLogin = () => {
  console.log('Iniciar sesión con', username.value, password.value)
}

const handleRegister = () => {
  console.log('Registrarse con', username.value, password.value, nombre.value, apellidos.value, curso.value, clase.value, mail.value, dni.value)
}
</script>