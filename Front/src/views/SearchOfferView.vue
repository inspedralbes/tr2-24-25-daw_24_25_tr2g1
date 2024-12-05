<template>
    <div class="forum-container">
        <div class="filters">
            <label for="mentor">Mentor:</label>
            <input type="text" id="mentor" v-model="searchMentor" placeholder="Pepe" />

            <label for="especialitat">Especialitat:</label>
            <select id="especialitat" v-model="selectedEspecialitat">
                <option value="">Totes</option>
                <option value="Matemáticas">Matemáticas</option>
                <option value="Inglés">Inglés</option>
                <option value="Ciencias">Ciencias</option>
                <option value="Ciencias Sociales">Ciencias Sociales</option>
                <option value="Ciencias Naturales">Ciencias Naturales</option>
            </select>

            <label for="hora">Hora:</label>
            <select id="hora" v-model="selectedHora">
                <option value="">Totes</option>
                <option value="8:00">8:00</option>
                <option value="8:30">8:30</option>
                <option value="9:00">9:00</option>
                <option value="9:30">9:30</option>
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

            <label for="dia">Dia:</label>
            <select id="dia" v-model="selectedDia">
                <option value="">Totes</option>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miercoles">Miercoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sabado">Sabado</option>
            </select>

            <label for="precio">Precio:</label>
            <select id="precio" v-model="selectedPrecio">
                <option value="">Totes</option>
                <option value="0-20">0€ - 20€</option>
                <option value="20-40">20€ - 40€</option>
                <option value="40-60">40€ - 60€</option>
                <option value="60-80">60€ - 80€</option>
                <option value="80-100">80€ - 100€</option>
            </select>

            <button @click="applyFilters">Aplicar filtres</button>
        </div>

        <div class="ads-list">
            <div v-for="ad in filteredAds" :key="ad.id" class="ad-item">
                <h4>{{ ad.especialitat }}</h4>
                <h3 class="ad-mentor">{{ ad.mentor }}</h3>
                <p class="ad-description">{{ ad.description }}</p>
                <button @click="viewAdDetails(ad.id)">Ver más</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';  
import { useRouter } from 'vue-router';

const router = useRouter();

const searchMentor = ref('');
const selectedEspecialitat = ref('');
const selectedHora = ref('');
const selectedDia = ref('');
const selectedPrecio = ref('');

const ads = ref([
    { id: 1, mentor: 'Pepe', especialitat: 'Matemáticas', hora: '8:00', dia: 'Lunes', precio: '20-40', description: 'Clase de álgebra' },
    { id: 2, mentor: 'Ana', especialitat: 'Inglés', hora: '10:00', dia: 'Martes', precio: '40-60', description: 'Clase de inglés avanzado' },
    { id: 3, mentor: 'Juan', especialitat: 'Ciencias', hora: '11:30', dia: 'Miercoles', precio: '20-40', description: 'Clase de química' },
    { id: 4, mentor: 'Lucía', especialitat: 'Matemáticas', hora: '9:00', dia: 'Jueves', precio: '60-80', description: 'Clase de geometría' },
]);

const filteredAds = ref([]);

const applyFilters = () => {
    filteredAds.value = ads.value.filter(ad => {
        return (
            (searchMentor.value === '' || ad.mentor.toLowerCase().includes(searchMentor.value.toLowerCase())) &&
            (selectedEspecialitat.value === '' || ad.especialitat === selectedEspecialitat.value) &&
            (selectedHora.value === '' || ad.hora === selectedHora.value) &&
            (selectedDia.value === '' || ad.dia === selectedDia.value) &&
            (selectedPrecio.value === '' || ad.precio === selectedPrecio.value)
        );
    });
};

// Inicia con todos los anuncios al cargar la página
applyFilters();

const viewAdDetails = (id) => {
    router.push(`/ad/${id}`);
};
</script>