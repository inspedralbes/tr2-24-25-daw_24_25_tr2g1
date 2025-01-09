import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isAuthenticated: false,
    token: null,
    rol: null, // Afegir el rol
    userId: null
  }),
  actions: {
    login(token, rol, userId) {
      this.isAuthenticated = true;
      this.token = token;
      this.rol = rol; // guardar el rol
      this.userId = userId ? parseInt(userId) : null;
      localStorage.setItem('token', token);
      localStorage.setItem('rol', rol); // guardar el rol també
      localStorage.setItem('userId', userId);
    },
    logout() {
      this.isAuthenticated = false;
      this.token = null;
      this.rol = null;
      this.userId = null;
      localStorage.removeItem('token');
      localStorage.removeItem('rol'); // eliminar el rol
      localStorage.removeItem('userId');
    },
    checkAuth() {
      const token = localStorage.getItem('token');
      const rol = localStorage.getItem('rol'); // obtenir el rol
      const userId = localStorage.getItem('userId');
      this.isAuthenticated = !!token;
      this.rol = rol; // carregar el rol
      this.userId = userId ? parseInt(userId) : null;
    },
  },
  persist:true,
});
