import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isAuthenticated: false,
    token: null,
    rol: null, // Afegir el rol
  }),
  actions: {
    login(token, rol) {
      this.isAuthenticated = true;
      this.token = token;
      this.rol = rol; // guardar el rol
      localStorage.setItem('token', token); 
      localStorage.setItem('rol', rol); // guardar el rol també
    },
    logout() {
      this.isAuthenticated = false;
      this.token = null;
      this.rol = null;
      localStorage.removeItem('token');
      localStorage.removeItem('rol'); // eliminar el rol
    },
    checkAuth() {
      const token = localStorage.getItem('token');
      const rol = localStorage.getItem('rol'); // obtenir el rol
      this.isAuthenticated = !!token;
      this.rol = rol; // carregar el rol
    },
  },
});
