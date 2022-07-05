import { createApp } from "vue"
import { createPinia } from "pinia"
import App from "./App.vue"
import router from "./router"
import "./index.css"
import { Presence, Motion } from "@motionone/vue"
import AbstractButton from "./components/AbstractButton.vue"
import axios from "axios"

const pinia = createPinia()
const app = createApp(App)

app.component("Presence", Presence)
app.component("Motion", Motion)
app.component("AbstractButton", AbstractButton)

const api = axios.create({
  baseURL: "http://localhost:80/api", //move to env
})

app.config.globalProperties.$http = api

app.use(pinia)
app.use(router)
app.mount("#app")
