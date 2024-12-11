<template>
    <!-- Signup -->
    <div class="signup-container" v-if="!showLogin && !forgotPassword">
        <p class="title">REGISTRAR-SEEEEE</p>
        <form class="form">
            <div class="input-group">
                <h3>Dades personals</h3>
                <br />
                <div class="flex">
                    <label>
                        <input class="input" type="text" placeholder="Nom" name="nom" id="nom" v-model="nom" />
                    </label>

                    <label>
                        <input class="input" type="text" placeholder="Primer Cognom" id="cognom1" name="cognom1"
                            v-model="cognom1"/>
                    </label>

                    <label>
                        <input class="input" type="text" placeholder="Segon Cognom" id="cognom2" name="cognom2"
                            v-model="cognom2"/>
                    </label>
                </div>

                <div class="flex">
                    <label>
                        <input type="date" name="data_naixement" id="data_naixement" v-model="data_naixement"
                            placeholder="Data Naixement" required/>
                    </label>

                    <label>
                        <select name="major" id="major" v-model="major" required>
                            <option value="" disabled selected>Major d'edat?</option>
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                        </select>
                    </label>
                    <label>
                        <select name="rol-select" id="rol-select" v-model="rol" required>
                            <option value="" disabled selected>Rol</option>
                            <option value="alumne">Alumne</option>
                            <option value="mentor">Mentor</option>
                            <option value="professor">Professor</option>
                        </select>
                    </label>

                    <div class="input-group" v-if="rol === 'alumne'">
                        <input type="text" v-model="curs" placeholder="Curs" required />
                    </div>
                    <div class="input-group" v-if="rol === 'mentor'">
                        <input type="text" v-model="especialitat" placeholder="Especialitat" required />
                    </div>
                    <div class="input-group" v-if="rol === 'professor'">
                        <input type="text" v-model="departament" placeholder="Departament" required />
                    </div>
                </div>
                <h3>Correu electrònic i telèfon</h3>
                <br />

                <div class="flex">
                    <label>
                        <input type="mail" name="correu" id="correu" v-model="correu" placeholder="Correu" required />
                    </label>
                    <label>
                        <input type="mail" name="correualternatiu" id="correualternatiu" placeholder="Correu Alternatiu"
                            v-model="correualternatiu" required />
                    </label>
                    <label>
                        <input type="text" name="telefon" id="telefon" v-model="telefon" placeholder="Telèfon" />
                    </label>
                </div>
                <h3>Contrasenya</h3>
                <br />
                <div class="flex">
                    <input type="password" name="password" id="password" v-model="password" placeholder="Contrasenya"
                        required />
                    <input type="password" name="password2" id="password2" v-model="password2"
                        placeholder="Confirmar Contrasenya" required />
                </div>

                <div class="input-group">
                    <h3 class="olvidar">En cas de perdre la contrasenya omple els camps següents:</h3>
                </div>

                <br />
                <div class="flex">
                    <select name="pregunta_secreta" id="pregunta_secreta" v-model="pregunta_secreta">
                        <option value="" disabled selected>Escull una pregunta</option>
                        <option value="Com es el nombre del teu primer amic?">
                            Com es el nombre del teu primer amic?
                        </option>
                        <option value="On vas fer la ESO?">On vas fer la ESO?</option>
                        <option value="El teu cotxe preferit?">El teu cotxe preferit?</option>
                    </select>
                    <input type="text" name="resposta_secreta" id="resposta_secreta" placeholder="Resposta"
                        v-model="resposta_secreta" />
                </div>
            </div>
            <button @click.prevent="registrarUsuari" class="sign">Registrar-se</button>
        </form>

        <!-- <div class="input-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" v-model="nom" placeholder="---" required />
      </div> -->

        <!-- <div class="input-group">
        <label for="cognom1">Primer cognom</label>
        <input type="text" name="cognom1" id="cognom1" v-model="cognom1" placeholder="---" required />
      </div>


      <div class="input-group">
        <label for="cognom2">Segon cognom</label>
        <input type="text" name="cognom2" id="cognom2" v-model="cognom2" placeholder="---" required />
      </div> -->

        <!-- <div class="input-group">
        <label for="password">Contrasenya</label>
        <input type="password" name="password" id="password" v-model="password" placeholder="---" required />
      </div> -->
        <!-- <div class="input-group">
    <label for="data_naixement">Data de naixement</label>
    <input type="date" name="data_naixement" id="data_naixement" v-model="data_naixement" placeholder="---" required />
  </div> -->

        <!-- <div class="input-group">
        <label for="telefon">Telefon</label>
        <input type="text" name="telefon" id="telefon" v-model="telefon" placeholder="---" />
      </div> -->
        <!-- <div class="input-group">

        <label for="password2">Confirmar contrasenya</label>
        <input type="password" name="password2" id="password2" v-model="password2" placeholder="---" required />
      </div> -->

        <!-- <div class="input-group">
        <label for="rol-select">Sel·lecciona el teu rol</label>
        <select name="rol-select" id="rol-select" v-model="rol" required>
          <option disabled selected value=""></option>
          <option value="alumne">Alumne</option>
          <option value="mentor">Mentor</option>
          <option value="professor">Professor</option>
        </select>
      </div> -->
        <!-- <div class="input-group" v-if="rol === 'alumne'">
        <input type="text" v-model="curs" placeholder="Curs" required />
      </div>
      <div class="input-group" v-if="rol === 'mentor'">
        <input type="text" v-model="especialitat" placeholder="Especialitat" required />
      </div>
      <div class="input-group" v-if="rol === 'professor'">
        <input type="text" v-model="departament" placeholder="Departament" required />
      </div> -->
        <!--
      <div class="input-group">

        <label for="correu">Correu</label>
        <input type="mail" name="correu" id="correu" v-model="correu" placeholder="---" required />
      </div>

      <div class="input-group">

        <label for="correualternatiu">Correu Alternatiu</label>
        <input type="mail" name="correualternatiu" id="correualternatiu" v-model="correualternatiu" placeholder="---"
          required />
      </div> -->

        <!-- <div class="input-group">
        <label for="major">Major d'edat</label>
        <input type="text" name="major" id="major" v-model="major" />
      </div> -->

        <!-- <div class="input-group">
        <h3><label>En cas de perdre la contrasenya omple els camps següents</label></h3>
      </div> -->

        <!-- Pregunta secreta -->
        <!-- <div class="input-group">
        <div class="input-group">
          <label for="pregunta_secreta">Tria una pregunta</label>
          <select name="pregunta_secreta" id="pregunta_secreta" v-model="pregunta_secreta">
            <option value="" disabled selected>---</option>
            <option value="Com es el nombre del teu primer amic?">Com es el nombre del teu primer amic?</option>
            <option value="On vas fer la ESO?">On vas fer la ESO?</option>
            <option value="El teu cotxe preferit?">El teu cotxe preferit?</option>
          </select>
        </div>
        <div class="input-group">
          <label for="resposta_secreta">Resposta</label>
          <input type="text" name="resposta_secreta" id="resposta_secreta" placeholder="---"
            v-model="resposta_secreta" />
        </div>
      </div> -->
        <!-- <button @click.prevent="registrarUsuari" class="sign">Registrar-se</button>
    </form> -->
        <div class="social-message">
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
        </div>
        <p class="signup">
            Tens un compte?
            <a @click="showLogin = !showLogin">Login</a>
        </p>
    </div>
</template>

<script setup>

import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

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
let departament = ref('')
let major = ref('')
let rol = ref('')
let curs = ref('')
let especialitat = ref('')

const router = useRouter()

async function registrarUsuari() {
    if (password.value !== password2.value) {
        alert('Les contrasenyes no coincideixen!')
        return
    }
    // Construir dades segons el rol
    const dadesUsuari = {
        nom: nom.value,
        cognom1: cognom1.value,
        cognom2: cognom2.value,
        password: password.value,
        data_naixement: data_naixement.value,
        correu: correu.value,
        correualternatiu: correualternatiu.value,
        pregunta_secreta: pregunta_secreta.value,
        resposta_secreta: resposta_secreta.value,
        telefon: telefon.value,
        rol: rol.value,
        major: major.value,
    }

    // Afegir només el camp rellevant segons el rol
    if (rol.value === 'alumne') {
        dadesUsuari.curs = curs.value
    } else if (rol.value === 'mentor') {
        dadesUsuari.especialitat = especialitat.value
    } else if (rol.value === 'professor') {
        dadesUsuari.departament = departament.value
    }

    console.log('Datos enviados al backend:', dadesUsuari)

    try {
        const resposta = await axios.post('http://localhost:8000/api/store', dadesUsuari)
        console.log('Usuari registrat:', resposta.data)
        alert('Usuari registrat correctament!')
        router.push('/forum')
    } catch (error) {
        console.error('Error desconegut:', error)
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
}
</style>

<!--
<style>
.flex {
  display: flex;
  width: 100%;
  gap: 6px;
}



.form-container {
  width: 320px;
  border-radius: 0.75rem;
  background-color: rgba(17, 24, 39, 1);
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
  background-color: rgba(167, 139, 250, 1);
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
</style> -->
