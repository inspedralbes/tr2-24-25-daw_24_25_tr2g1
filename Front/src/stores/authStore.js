import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isAuthenticated: false,
    token: null,
    rol: null, // Afegir el rol
    userId: null,
    username: null,
    userMail: null
  }),
  actions: {
    login(token, rol, userId, userMail, username) {
      this.isAuthenticated = true;
      this.token = token;
      this.rol = rol; // guardar el rol
      this.userId = userId ? parseInt(userId) : null;
      this.username = username; // guardar el nom d'usuari
      this.userMail = userMail;
      localStorage.setItem('token', token);
      localStorage.setItem('rol', rol); // guardar el rol també
      localStorage.setItem('userId', userId);
      localStorage.setItem('username', username); // guarda el nom d'usuari
      localStorage.setItem('userId', userMail); // guarda el correu
    },
    logout() {
      this.isAuthenticated = false;
      this.token = null;
      this.rol = null;
      this.userId = null;
      this.username = null;
      this.userMail = null;
      localStorage.removeItem('token');
      localStorage.removeItem('rol'); // eliminar el rol
      localStorage.removeItem('userId');
      localStorage.removeItem('username'); // eliminar el nom d'usuari
      localStorage.removeItem('userMail');
    },
    checkAuth() {
      const token = localStorage.getItem('token');
      const rol = localStorage.getItem('rol'); // obtenir el rol
      const userId = localStorage.getItem('userId');
      const username = localStorage.getItem('username');
      const userMail = localStorage.getItem('userMail');
      this.isAuthenticated = !!token;
      this.rol = rol; // carregar el rol
      this.userId = userId ? parseInt(userId) : null;
      this.username = username; // carregar el nom d'usuari
      this.userMail = userMail;
    },
  },
  persist:true,
});
