import { defineStore } from "pinia"

export const useThemeStore = defineStore("theme", {
  state: () => ({
    darkMode: false,
  }),

  getters: {
    getTheme(state) {
      return state.darkMode
    },
  },

  actions: {
    toggleTheme() {
      this.darkMode = !this.darkMode
    },
  },
})
