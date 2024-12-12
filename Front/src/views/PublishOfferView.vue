<template>
    <div class="publish-container">
    <h2>Publicar oferta</h2>
    <form onsubmit="publish.submitForm()">
      <div class="form-group">
        <label for="titulo">Títol de la classe</label>
        <input type="text" name="Titol" id="titulo" placeholder="Escriu el títol" required v-model="publish.titol.value" />
      </div>

      <div class="form-group">
        <label for="especialitat">Especialitat de la classe</label>
        <input type="text" name="especialitat" id="especialitat" placeholder="Especialitat" v-model="publish.especialitat.value"required />
      </div>

      <div class="form-group">
        <label for="contingut">Contingut de la classe</label>
        <textarea name="Contingut" id="contingut" placeholder="Descripció del contingut" rows="4" v-model="publish.contingut.value" required></textarea>
      </div>

      <div class="form-group">
        <label for="data">Dia</label>
        <input type="date" name="data" id="data" v-model="publish.data" required />
      </div>

      <div class="form-group">
        <label for="horaInici">Hora d'inici</label>
        <select name="horaInici" id="horaInici" v-model="publish.horaInici" required>
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
        <select name="horaFinal" id="horaFinal" v-model="publish.horaFinal" required>
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
        <button type="submit">Publicar Oferta</button>
      </div>
    </form>
  </div>
</template>
  

<script setup>
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