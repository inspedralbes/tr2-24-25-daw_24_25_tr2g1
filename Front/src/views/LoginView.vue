<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/authStore';
import Swal from 'sweetalert2'
import { passwordService } from '@/services/communicationManager';

let showLogin = ref(true)
let forgotPassword = ref(false)
// let canviarContrasenya = ref(false)
const router = useRouter()
const authStore = useAuthStore();

const etapaFormulario = ref('email')
const email = ref('')
const codigo = ref('')
const nuevaContrasenya = ref('')
const confirmarContraseña = ref('')

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
  etapaFormulario.value = 'email'
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
    let username = data.usuari.correu.split('@')[0];
    localStorage.setItem('token', data.token)
    localStorage.setItem('rol', data.usuari.rol); // Al fer login, guardar el rol
    localStorage.setItem('userId', data.usuari.id.toString());
    localStorage.setItem('username', username);
    localStorage.setItem('mail', data.usuari.correu);

    authStore.login(data.token, data.usuari.rol, data.usuari.id, data.usuari.correu, username);
    console.log('User ID:', data.usuari.id);
    console.log('Mail:', data.usuari.correu);
    console.log('Username:', username);

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

// Función para enviar el correo y recibir el código
async function enviarCodigoRecuperacion() {
  try {
    await passwordService.enviarCodigoRecuperacion(email.value)

    Swal.fire({
      position: 'top',
      icon: 'success',
      title: 'Codi enviat correctament',
      showConfirmButton: false,
      timer: 2500,
    })
    etapaFormulario.value = 'codigo'
  } catch (error) {
    Swal.fire({
      position: 'top',
      icon: 'error',
      title: 'Error al enviar el codi',
      showConfirmButton: false,
      timer: 2500,
    })
  }
}

// Función para verificar el código
async function verificarCodigo() {
  try {
    await passwordService.verificarCodigo(email.value, codigo.value)
    etapaFormulario.value = 'nuevaContraseña'
  } catch (error) {
    Swal.fire({
      position: 'top',
      icon: 'error',
      title: 'Codi incorrecte',
      text: 'Por favor, verifique el código e intente nuevamente',
      showConfirmButton: false,
      timer: 2500
    })
  }
}

// Función para restablecer la contraseña
async function restablecerContraseña() {
  try {
    console.log('Password verification:', {
      nueva: nuevaContrasenya.value,
      confirmar: confirmarContraseña.value
    });

    if (nuevaContrasenya.value !== confirmarContraseña.value) {
      Swal.fire({
        position: 'top',
        icon: 'error',
        title: 'Las contraseñas no coincidenaaaaaaaa',
        showConfirmButton: false,
        timer: 2500,
      });
      return;
    }

    // Add trim() to remove any whitespace
    const result = await passwordService.restablecerContraseña(email.value.trim(),nuevaContrasenya.value,codigo.value);

    if (result.message === 'Contraseña actualizada correctamente') {
      Swal.fire({
        position: 'top',
        icon: 'success',
        title: 'Contraseña restablecida correctamente',
        showConfirmButton: false,
        timer: 2500,
      });
      router.push('/login');
    }
  } catch (error) {
    Swal.fire({
      position: 'top',
      icon: 'error',
      title: error.message || 'Error al restablecer la contraseña',
      showConfirmButton: false,
      timer: 2500,
    });
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

    <!-- Formulario de correo -->
    <div v-if="etapaFormulario === 'email' && !showLogin">
      <p class="title">RECUPERAR CONTRASEÑA</p>
      <form class="form">
        <div class="input-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" v-model="email" placeholder="a23alumnet@inspedralbes.cat" required />
        </div>
        <button class="sign" @click.prevent="enviarCodigoRecuperacion">Enviar código</button>
      </form>
    </div>

    <!-- Formulario de verificacion de codigo -->
    <div v-if="etapaFormulario === 'codigo'">
      <p class="title">VERIFICAR CÓDIGO</p>
      <form class="form">
        <div class="input-group">
          <label for="codigo">Código de verificación</label>
          <input type="text" id="codigo" v-model="codigo" placeholder="Ingrese el código de 6 dígitos" maxlength="6"
            pattern="\d{6}" required />
        </div>
        <button class="sign" @click.prevent="verificarCodigo">Verificar código</button>
      </form>
    </div>

    <!-- Formulario de nueva contraseña -->
    <div v-if="etapaFormulario === 'nuevaContraseña'">
      <p class="title">NUEVA CONTRASEÑA</p>
      <form class="form">
        <div class="input-group">
          <label for="nuevaContraseña">Nueva contraseña</label>
          <input type="password" id="nuevaContraseña" v-model="nuevaContrasenya"
            placeholder="Ingrese su nueva contraseña" required />
        </div>
        <div class="input-group">
          <label for="confirmarContraseña">Confirmar contraseña</label>
          <input type="password" id="confirmarContraseña" v-model="confirmarContraseña"
            placeholder="Confirme su nueva contraseña" required />
        </div>
        <button class="sign" @click.prevent="restablecerContraseña">
          Restablecer contraseña
        </button>
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
    background-color: rgba(17, 24, 39, 1);
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
