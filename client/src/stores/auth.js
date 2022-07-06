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
    setAuth(user) {
      this.user = user

      // set tokens as well
    },

    resetAuth() {
      this.user = null

      // remove tokens
    },
  },
})
