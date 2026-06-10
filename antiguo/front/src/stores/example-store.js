import { defineStore } from 'pinia'

export const useCounterStore = defineStore('counter', {
  state: () => ({
    counter: 0,
    user: {},
    agencia: {},
    productosVenta: [],
    porcentaje: 0,
    isLoggedIn: !!localStorage.getItem('tokenNeuro'),
    env: {}
  }),
  getters: {
    doubleCount: (state) => state.counter * 2
  },
  actions: {
    increment () {
      this.counter++
    }
  }
})
