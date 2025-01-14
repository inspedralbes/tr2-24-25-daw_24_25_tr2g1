import './assets/normalize.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

// import { io } from "socket.io-client";
// const socket = io("http://localhost:3000");
// app.config.globalProperties.$socket = socket;

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)
app.use(router)
app.mount('#app')