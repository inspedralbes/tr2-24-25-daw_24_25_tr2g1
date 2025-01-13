<template>
  <div class="signup-container">
    <p class="title">REGISTRAR-SE</p>
    <form class="form">
      <div class="input-group">
        <h2>Correu electrònic</h2>
        <br />

        <div class="flex">
          <label>
            <input type="mail" name="correu" id="correu" v-model="correu" placeholder="Correu"
              :class="{ 'input-error': isEmailInvalid }" @input="validateEmail" required />
          </label>
          <label>
            <input type="mail" name="correualternatiu" id="correualternatiu" placeholder="Correu Alternatiu"
              v-model="correualternatiu" required />
          </label>
        </div>

        <p v-if="isEmailInvalid" class="error-message">{{ emailErrorMessage }}</p>
        <br />

        <h2>Contrasenyes</h2>
        <br />
        <div class="flex">
          <input type="password" name="password" id="password" v-model="password" placeholder="Contrasenya" required />
          <input type="password" name="password2" id="password2" v-model="password2" placeholder="Confirmar Contrasenya"
            required />
        </div>

        <div class="input-group">
          <h3 class="olvidar">En cas de perdre la contrasenya omple els camps següents:</h3>
        </div>

        <br />

        <div class="flex">
          <select name="pregunta_secreta" id="pregunta_secreta" v-model="pregunta_secreta" required>
            <option value="" disabled selected>Tria una pregunta</option>
            <option value="Nom primer amic?">Quin és el nom del teu primer amic?</option>
            <option value="On ESO?">On vas fer la ESO?</option>
            <option value="Cotxe preferit?">Quin és el teu cotxe preferit?</option>
          </select>
          <input type="text" name="resposta_secreta" id="resposta_secreta" placeholder="Resposta"
            v-model="resposta_secreta" />
        </div>
      </div>

      <button @click.prevent="registrarUsuari" class="sign">Registrar-se</button>
    </form>

    <!-- <div class="social-message">
      <div class="line"></div>
      <p class="message">Registrar-se amb</p>
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
      Tens un compte?
      <a @click="router.push('/login')">Inicia sessió</a>
    </p>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useRouter } from 'vue-router'
import Swal from 'sweetalert2'

let password = ref('')
let password2 = ref('')
let correu = ref('')
let correualternatiu = ref('')
let pregunta_secreta = ref('')
let resposta_secreta = ref('')

const router = useRouter()

// Email validation
const emailPatterns = {
  alumne: /^[a-zA-Z][0-9]{2}/,
  mentor: /^[a-zA-Z][0-9]{2}/,
  professor: /^(?![a-zA-Z][0-9]{2}).*@.+\..+$/,
}

const isEmailInvalid = computed(() => {
  if (!correu.value) {
    return false
  }
  const validEmailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  return !validEmailPattern.test(correu.value)
})

// Email validation message
const emailErrorMessage = computed(() => {
  return isEmailInvalid.value ? 'El correu introduït no és vàlid.' : ''
})

async function registrarUsuari() {
  // Password match check
  if (password.value !== password2.value) {
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Les contrasenyes no coincideixen!',
        showConfirmButton: false,
        timer: 2500,
      })
    return
  }

  // Email validation
  if (isEmailInvalid.value) {
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'El correu introduït no és vàlid.',
        showConfirmButton: false,
        timer: 2500,
      })
    return
  }

  // Construir dades de l'usuari
  const dadesUsuari = {
    password: password.value,
    correu: correu.value,
    correualternatiu: correualternatiu.value,
    pregunta_secreta: pregunta_secreta.value,
    resposta_secreta: resposta_secreta.value,
  }

  console.log('Dades enviades al backend:', dadesUsuari)

  try {
    const response = await fetch('http://alumnet.daw.inspedralbes.cat/laravel/public/api/store', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
      },
      body: JSON.stringify(dadesUsuari),
    })

    if (!response.ok) {
      const errorData = await response.json()
      throw new Error(errorData.message || 'Error al registrar usuari')
    }

    const respostaData = await response.json()
    console.log('Usuari registrat:', respostaData)
    Swal.fire({
      position: 'top',
      icon: 'success',
      title: 'Usuari registrat correctament!',
      showConfirmButton: false,
      timer: 2500,
    })
    router.push('/forum')
  } catch (error) {
    Swal.fire({
      position: 'top',
      icon: 'error',
      title: 'Usuari registrat incorrectament!',
      showConfirmButton: false,
      timer: 2500,
    })
  }
}
</script>

<style>
.signup-container {
  width: 100%;
  max-width: 850px;
  margin: 2rem auto;
  background-color: #0a0a0a;
  color: #fff;
  padding: 3rem;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(255, 255, 255, 0.05);
  border: 1px solid #222;
  width: 100%;
  max-width: 850px;
  margin: 2rem auto;
  background-color: #0a0a0a;
  color: #fff;
  padding: 3rem;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(255, 255, 255, 0.05);
  border: 1px solid #222;
}

.input-error {
  border: 2px solid red !important;
  background-color: rgba(255, 0, 0, 0.1);
}

.input-group input[type='mail'].input-error {
  border: 2px solid red !important;
  background-color: rgba(255, 0, 0, 0.1);
}

.invalid-email {
  border-color: red;
}

.error-message {
  color: red;
  font-size: 0.875rem;
  margin-top: 0.5rem;
}

.title {
  text-align: center;
  font-size: 2rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 2.5rem;
  letter-spacing: -0.5px;
}

.flex {
  display: flex;
  width: 100%;
  gap: 1rem;
  margin-bottom: 1rem;
}

.form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.input-group input,
.input-group select {
  width: 100%;
  padding: 1rem 1.25rem;
  background-color: #141414;
  color: #fff;
  border: 1px solid #333;
  border-radius: 8px;
  outline: none;
  transition: all 0.3s ease;
  font-size: 1rem;
}

.input-group input:focus,
.input-group select:focus {
  border-color: #555;
  box-shadow: 0 0 0 3px rgba(85, 85, 85, 0.2);
}

.input-group select option {
  background-color: #1a1a1a;
  color: #fff;
}

.sign {
  width: 100%;
  padding: 1rem;
  background-color: #353535;
  color: #fff;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  font-size: 1.1rem;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-top: 1rem;
}

.sign:hover {
  background-color: #4a4a4a;
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
}

.social-message {
  display: flex;
  align-items: center;
  margin: 2rem 0;
}

.line {
  height: 1px;
  flex: 1;
  background-color: #333;
}

.social-message .message {
  padding: 0 1rem;
  color: #888;
  font-size: 1rem;
}

.social-icons {
  display: flex;
  justify-content: center;
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.social-icons .icon {
  background-color: #1e1e1e;
  border: none;
  border-radius: 50%;
  padding: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.social-icons .icon:hover {
  background-color: #2a2a2a;
  transform: scale(1.1);
  box-shadow: 0 6px 12px rgba(255, 255, 255, 0.1);
}

.social-icons .icon img {
  height: 1.5rem;
  width: 1.5rem;
}

.signup {
  text-align: center;
  color: #888;
  font-size: 1rem;
  margin-top: 1.5rem;
}

.signup a {
  color: #fff;
  text-decoration: none;
  cursor: pointer;
  transition: color 0.3s ease;
}

.signup a:hover {
  color: #ddd;
  text-decoration: underline;
}

.olvidar {
  color: red;
  font-weight: bold;
}

@media (max-width: 768px) {
  .signup-container {
    margin: 1rem;
    padding: 2rem;
  }

  .flex {
    flex-direction: column;
    gap: 1rem;
  }

  .flex {
    flex-direction: column;
    gap: 1rem;
  }
}
</style>
