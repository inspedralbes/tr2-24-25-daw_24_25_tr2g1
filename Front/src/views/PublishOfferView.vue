<template>
    <div class="publish-container">
    <h2>Publicar oferta</h2>
    <form>
      <div class="form-group">
        <label for="titulo">Títol de la classe</label>
        <input type="text" name="Titol" id="titulo" placeholder="Escriu el títol" required v-model="titol" />
      </div>

      <div class="form-group">
        <label for="especialitat">Especialitat de la classe</label>
        <input type="text" name="especialitat" id="especialitat" placeholder="Especialitat" v-model="especialitat"required />
      </div>

      <div class="form-group">
        <label for="contingut">Contingut de la classe</label>
        <textarea name="Contingut" id="contingut" placeholder="Descripció del contingut" rows="4" v-model="contingut" required></textarea>
      </div>

      <div class="form-group">
        <label for="data">Dia</label>
        <input type="date" name="data" id="data" v-model="data" required />
      </div>

      <div class="form-group">
        <label for="horaInici">Hora d'inici</label>
        <select name="horaInici" id="horaInici" v-model="horaInici" required>
          <option value="08:00">8:00</option>
          <option value="08:30">8:30</option>
          <option value="09:00">9:00</option>
          <option value="09:30">9:30</option>
          <option value="10:00">10:00</option>
          <option value="10:30">10:30</option>
          <option value="11:00">11:00</option>
          <option value="11:30">11:30</option>
          <option value="12:00">12:00</option>
          <option value="12:30">12:30</option>
          <option value="13:00">13:00</option>
          <option value="13:30">13:30</option>
          <option value="14:00">14:00</option>
        </select>
      </div>

      <div class="form-group">
        <label for="horaFinal">Hora final</label>
        <select name="horaFinal" id="horaFinal" v-model="horaFinal" required>
          <option value="08:30">8:30</option>
          <option value="09:00">9:00</option>
          <option value="09:30">9:30</option>
          <option value="10:00">10:00</option>
          <option value="10:30">10:30</option>
          <option value="11:00">11:00</option>
          <option value="11:30">11:30</option>
          <option value="12:00">12:00</option>
          <option value="12:30">12:30</option>
          <option value="13:00">13:00</option>
          <option value="13:30">13:30</option>
          <option value="14:00">14:00</option>
          <option value="14:30">14:30</option>
        </select>
      </div>

      <div class="form-group">
        <button type="submit" @click.prevent="submit">Publicar Oferta</button>
      </div>
    </form>
  </div>
</template>


<script>
import { ref } from "vue";

import * as com from "@/services/communicationManager.js"; 

export default {
  setup() {
    // Definimos las variables reactivas con `ref`
    const titol = ref("");
    const especialitat = ref("");
    const contingut = ref("");
    const data = ref("");
    const horaInici = ref("");
    const horaFinal = ref("");
    //const id_usuari = ref(1); Falta per fer perque necesita l'id de l 'usuari loggejat

    // Lógica de validación y envío
    const submit = async () => {
      if (horaInici.value >= horaFinal.value) {
        alert("L'hora final ha de ser posterior a l'hora d'inici.");
        return;
      }

      // Simula enviar els dades
      const oferta = {
        titol: titol.value,
        especialitat: especialitat.value,
        contingut: contingut.value,
        //data: data.value,
        horaInici: horaInici.value,
        horaFinal: horaFinal.value,
        id_usuari: 1, // Per defecte de moment es guarda l'id de l'usuari 1
        dia: 'Dilluns' // Per defecte de moment es guarda el dia dilluns
      };

      const data =  await com.fetchPublicaciones(oferta);
      console.log("Vue",data);
      
      console.log("Oferta enviada:", oferta);
      alert("Oferta publicada correctament!");

      // Reinicia els camps
      titol.value = "";
      especialitat.value = "";
      contingut.value = "";
      //data.value = "";
      horaInici.value = "";
      horaFinal.value = "";
    };

    // Devuelve las variables y la función de envío
    return {
      titol,
      especialitat,
      contingut,
      data,
      horaInici,
      horaFinal,
      submit,
    };
  },
};
</script>

<style scoped>
.publish-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background-color: #f9f9f9;
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input, textarea, select, button {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
</style>