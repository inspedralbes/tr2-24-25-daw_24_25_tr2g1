<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/authStore';
import Swal from 'sweetalert2'

let showLogin = ref(true)
let forgotPassword = ref(false)
let canviarContrasenya = ref(false)
const router = useRouter()
const authStore = useAuthStore();

let nom = ref('')
let cognom1 = ref('')
let cognom2 = ref('')
let password = ref('')
let password2 = ref('')
let data_naixement = ref('')
let correu = ref('')
let correualternatiu = ref('')
let pregunta_secreta = ref('')
let telefon = ref('')
let resposta_secreta = ref('')
let rol = ref('')
let curs = ref('')
let especialitat = ref('')
let departament = ref('')
let major = ref('')

function showForgotPassword() {
  forgotPassword.value = !forgotPassword.value
  showLogin.value = !showLogin.value
}

async function login() {
  try {
    // Agafem els valors dels camps del formulari
    const correu = document.querySelector('#correu').value
    const password = document.querySelector('#contrasenya').value

    // Enviem la sol·licitud al servidor amb fetch
    const resposta = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        correu, // Aquí és "correu" en lloc de "email"
        password,
      }),
    })

    // Comprovem si la resposta és correcta
    if (!resposta.ok) {
      throw new Error('Error al fer login')
    }

    const data = await resposta.json()
    console.log('Resposta del servidor:', data);

    if (!data.token || !data.usuari || !data.usuari.id) {
      throw new Error('Faltan datos del usuari');
    }


    // Guarda el token al localStorage (opcional)
    localStorage.setItem('token', data.token)
    localStorage.setItem('rol', data.usuari.rol); // Al fer login, guardar el rol
    localStorage.setItem('userId', data.usuari.id.toString());

    authStore.login(data.token, data.usuari.rol, data.usuari.id);
    console.log('User ID:', data.usuari.id);


    // Actualitzem el store per verificar l'autenticació
    authStore.checkAuth()
    Swal.fire({
      position: 'top',
      icon: 'success',
      title: 'Has iniciat sessió correctament!',
      showConfirmButton: false,
      timer: 2500,
    })
    router.push('/forum')
  } catch (error) {
    Swal.fire({
      position: 'top',
      icon: 'error',
      title: 'Inici de sessió incorrecte! Torna-ho a provar.',
      showConfirmButton: false,
      timer: 2500,
    })
    router.push('/login')
  }
}
</script>
<template>
  <div class="form-container">
    <!-- Login -->
    <div class="login-container" v-if="showLogin">
      <p class="title">INICIAR SESSIÓ</p>
      <form class="form">
        <div class="input-group">
          <label for="correu">Correu</label>
          <input type="text" name="correu" id="correu" placeholder="a24alumnet@inspedralbes.cat" />
        </div>
        <div class="input-group">
          <label for="contrasenya">Contrasenya</label>
          <input type="password" name="contrasenya" id="contrasenya" placeholder="---" />
          <div class="forgot">
            <a rel="noopener noreferrer" href="#" @click="showForgotPassword">Has oblidat la contrasenya?</a>
          </div>
        </div>
        <button @click.prevent="login" class="sign">Iniciar sessió</button>
      </form>
      <!-- <div class="social-message">
        <div class="line"></div>
        <p class="message">Iniciar sessió amb</p>
        <div class="line"></div>
      </div>
      <div class="social-icons">
        <button aria-label="Log in with Google" class="icon">
          <img src="/src/assets/icons/google-logo.svg" />
        </button>
        <button aria-label="Log in with GitHub" class="icon">
          <img src="/src/assets/icons/github.svg" />
        </button>
      </div> -->
      <p class="signup">
        No tens un compte?
        <a @click="router.push('/register')">Registrar-se</a>
      </p>
    </div>

    <!-- Forgot Password -->
    <div class="forgotPassword-container" v-if="forgotPassword">
      <p class="title">RECUPERAR CONTRASENYA</p>
      <form class="form">
        <div class="input-group">
          <label for="correu">Correu</label>
          <input type="text" name="correu" id="correu" placeholder="a24alumnet@inspedralbes.cat" />
        </div>
        <div class="input-group">
          <label for="pregunta_secreta">Pregunta secreta</label>
          <select name="pregunta_secreta" id="">
            <option value="" disabled selected>---</option>
            <option value="pregunta_secreta">Com es el nombre del teu primer amic?</option>
            <option value="pregunta_secreta">On vas fer l'ESO?</option>
            <option value="pregunta_secreta">El teu cotxe preferit?</option>
          </select>
        </div>
        <div class="input-group">
          <label for="resposta">Resposta</label>
          <input type="text" name="resposta" id="resposta" placeholder="---" />
          <div class="forgot"></div>
        </div>
        <button class="sign" @click="canviarContrasenya = !canviarContrasenya">
          Recuperar compte
        </button>
      </form>
    </div>
    <!-- Crear contrasenya -->
    <div class="crear-contrasenya-container" v-if="canviarContrasenya">
      <p class="title">CREAR CONTRASENYA</p>
      <form class="form">
        <div class="input-group">
          <label for="novaContrasenya">Nova contrasenya</label>
          <input type="password" name="novaContrasenya" id="novaContrasenya" placeholder="---" />
        </div>
        <div class="input-group">
          <label for="novaContrasenya">Confirmar contrasenya</label>
          <input type="password" name="novaContrasenya" id="novaContrasenya" placeholder="---" />
          <div class="forgot"></div>
        </div>
        <button class="sign">Guardar</button>
      </form>
    </div>
  </div>
</template>

<style>
.form-container {
  width: 320px;
  border-radius: 0.75rem;
  background-color: rgb(0, 0, 0);
  padding: 2rem;
  color: rgba(243, 244, 246, 1);
}

.title {
  text-align: center;
  font-size: 1.5rem;
  line-height: 2rem;
  font-weight: 700;
}

.form {
  margin-top: 1.5rem;
}

.input-group {
  margin-top: 0.25rem;
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.input-group label {
  display: block;
  color: rgba(156, 163, 175, 1);
  margin-bottom: 4px;
}

.input-group input {
  width: 100%;
  border-radius: 0.375rem;
  border: 1px solid rgba(55, 65, 81, 1);
  outline: 0;
  background-color: rgba(17, 24, 39, 1);
  padding: 0.75rem 1rem;
  color: rgba(243, 244, 246, 1);
}

.input-group input:focus {
  border-color: rgba(167, 139, 250);
}

.forgot {
  display: flex;
  justify-content: flex-end;
  font-size: 0.75rem;
  line-height: 1rem;
  color: rgba(156, 163, 175, 1);
  margin: 8px 0 14px 0;
}

.forgot a,
.signup a {
  color: rgba(243, 244, 246, 1);
  text-decoration: none;
  font-size: 14px;
  cursor: pointer;
}

.forgot a:hover,
.signup a:hover {
  text-decoration: underline rgba(167, 139, 250, 1);
}

.sign {
  display: block;
  width: 100%;
  background-color: rgb(66, 14, 222);
  padding: 0.75rem;
  text-align: center;
  color: rgba(17, 24, 39, 1);
  border: none;
  border-radius: 0.375rem;
  font-weight: 600;
}

.social-message {
  display: flex;
  align-items: center;
  padding-top: 1rem;
}

.line {
  height: 1px;
  flex: 1 1 0%;
  background-color: rgba(55, 65, 81, 1);
}

.social-message .message {
  padding-left: 0.75rem;
  padding-right: 0.75rem;
  font-size: 0.875rem;
  line-height: 1.25rem;
  color: rgba(156, 163, 175, 1);
}

.social-icons {
  padding: 1rem;
  display: flex;
  justify-content: center;
  gap: 1vh;
}

.social-icons .icon {
  border-radius: 0.125rem;
  padding: 0.8rem;
  border: none;
  border-radius: 5rem;
  background-color: white;
}

.social-icons .icon img {
  height: 1.25rem;
  width: 1.5rem;
}

.signup {
  text-align: center;
  font-size: 0.75rem;
  line-height: 1rem;
  color: rgba(156, 163, 175, 1);
}

.input-group select {
  width: 100%;
  border-radius: 0.375rem;
  border: 1px solid rgba(55, 65, 81, 1);
  outline: 0;
  background-color: rgba(17, 24, 39, 1);
  padding: 0.75rem 1rem;
  color: rgba(243, 244, 246, 1);
}
</style>
