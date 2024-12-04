<template>
    <div class="publish-container">
        <h2>Publicar Oferta</h2>
        <div class="publish-container">
            <form>
                <br><input type="text" name="Titol" id="" placeholder="Titol de la clase">
                <br><input type="text" name="Contingut" id="" placeholder="Contingut de la classe"> 
                <br><input type="text" name="idUsuari" id="" placeholder="ID Usuari"> 
                <br>Estat<select name="Estat" id="">
                    <option value="">Actiu</option>
                    <option value="">Ocult</option>
                </select>
                <br><input type="date" name="" id="">Dia
                <br>
                Hora Inicio:
                <br><select name="horaInici" id="">
                    <option value="">8:00</option>
                    <option value="">8:30</option>
                    <option value="">9:00</option>
                    <option value="">9:30</option>
                    <option value="">10:00</option>
                    <option value="">10:30</option>
                    <option value="">11:00</option>
                    <option value="">11:30</option>
                    <option value="">12:00</option>
                    <option value="">12:30</option>
                    <option value="">13:00</option>
                    <option value="">13:30</option>
                    <option value="">14:00</option>
                </select><br>
               <br> Hora Final:
                <br><select name="horaFinal" id="">
                    <option value="">8:30</option>
                    <option value="">9:00</option>
                    <option value="">9:30</option>
                    <option value="">10:00</option>
                    <option value="">10:30</option>
                    <option value="">11:00</option>
                    <option value="">11:30</option>
                    <option value="">12:00</option>
                    <option value="">12:30</option>
                    <option value="">13:00</option>
                    <option value="">13:30</option>
                    <option value="">14:00</option>
                    <option value="">14:30</option>
                </select>
                <br><input type="submit" value="Publicar Oferta">
            </form>
        </div>
    </div>
</template>
  

<script setup>
import { ref } from 'vue';

const titol = ref('');
const contingut = ref('');
const idUsuari = ref('');
const estat = ref(false);
const dia = ref('');
const horaInici = ref('');
const horaFinal = ref('');

const enviarFormulario = async () => {
    const datos = {
        titol: titol.value,
        contingut: contingut.value,
        idUsuari: idUsuari.value,
        estat: estat.value,
        dia: dia.value,
        horaInici: horaInici.value,
        horaFinal: horaFinal.value,
    };

    try {
        const respuesta = await fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(datos),
        });
        const resultado = await respuesta.json();
    } catch (error) {
        console.error('Error al enviar los datos:', error);
    }
};
</script>