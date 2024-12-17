import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isAuthenticated: false, // Estat inicial: l'usuari no està autenticat
  }),
  actions: {
    login(token) {
      this.isAuthenticated = true
      localStorage.setItem('token', 'token') // Canvia l'estat quan l'usuari inicia sessió
    },
    logout() {
      this.isAuthenticated = false // Torna a fals quan l'usuari tanca sessió
      localStorage.removeItem('token') // Elimina el token de sessió
    },
    checkAuth() {
      const token = localStorage.getItem('token')
      console.log('Token trobat:', token) // Comprova si el token existeix
      this.isAuthenticated = !!token
      console.log('isAuthenticated després del checkAuth:', this.isAuthenticated)
    },
  },
})
