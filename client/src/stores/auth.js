import { defineStore } from "pinia"
import api from "../main"

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

    async checkForToken() {
      let token

      if (sessionStorage.getItem("token")) {
        token = JSON.parse(sessionStorage.getItem("token"))
      } else if (localStorage.getItem("token")) {
        token = JSON.parse(localStorage.getItem("token"))
      } else {
        return false
      }

      api.defaults.headers.common[
        "Authorization"
      ] = `${token.token_type} ${token.access_token}`

      this.setAuth(token)

      await api
        .get("/getuser")
        .then(({ data }) => {
          this.setUser(data)
        })
        .catch((err) => {
          console.log(err)

          return false
        })

      return true
    },
  },
})
