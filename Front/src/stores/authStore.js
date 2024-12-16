import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isAuthenticated: false, // Estat inicial: l'usuari no està autenticat
  }),
  actions: {
    login() {
      this.isAuthenticated = true; // Canvia l'estat quan l'usuari inicia sessió
    },
    logout() {
      this.isAuthenticated = false; // Torna a fals quan l'usuari tanca sessió
      localStorage.removeItem('token'); // Elimina el token de sessió
    },
    checkAuth() {
      // Comprova si hi ha un token al localStorage
      const token = localStorage.getItem('token');
      this.isAuthenticated = !!token;
    },
  },
});
