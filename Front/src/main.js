import './assets/normalize.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import { io } from "socket.io-client";

const socket = io("http://localhost:3000");

const pinia = createPinia()
const app = createApp(App)
app.config.globalProperties.$socket = socket; // Sirve para acceder al socket desde cualquier componente

app.use(pinia)
app.use(router)
app.mount('#app')