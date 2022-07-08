import { defineStore } from "pinia"

export const useAuth = defineStore("auth", {
  state: () => ({
    user: null,
  }),

  getters: {
    isAuth: (state) => state.user !== null,
    getCurrentUser: (state) => state.user,
  },

  actions: {
    setAuth(data) {
      console.log("setting auth")
      sessionStorage.setItem("token", JSON.stringify(data))
    },

    setUser(data) {
      this.user = data
    },

    logout() {
      this.user = null
      sessionStorage.removeItem("token")
      localStorage.removeItem("token")
    },
  },
})
