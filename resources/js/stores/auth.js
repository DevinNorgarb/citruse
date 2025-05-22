import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token'),
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
    isSystemAdministrator: (state) => state.user?.role === 'system_administrator',
    isPurchasingManager: (state) => state.user?.role === 'purchasing_manager',
    isFieldSalesAssociate: (state) => state.user?.role === 'field_sales_associate',
  },

  actions: {
    async login(email, password) {
      try {
        const response = await axios.post('/api/login', { email, password })
        this.token = response.data.token
        this.user = response.data.user
        localStorage.setItem('token', this.token)
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      } catch (error) {
        throw error
      }
    },

    async logout() {
      try {
        await axios.post('/api/logout')
        this.token = null
        this.user = null
        localStorage.removeItem('token')
        delete axios.defaults.headers.common['Authorization']
      } catch (error) {
        console.error('Logout error:', error)
      }
    },

    async fetchUser() {
      try {
        const response = await axios.get('/api/user')
        this.user = response.data
      } catch (error) {
        console.error('Fetch user error:', error)
        this.logout()
      }
    },

    initialize() {
      if (this.token) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.fetchUser()
      }
    },
  },
})