import { createApp } from "vue"
import { createPinia } from "pinia"
import App from "./App.vue"
import router from "./router"
import "./index.css"
import { Presence, Motion } from "@motionone/vue"
import AbstractButton from "./components/buttons/AbstractButton.vue"
import TextButton from "./components/buttons/TextButton.vue"
import Throbber from "./components/buttons/Throbber.vue"
import FormInput from "@/components/form/FormInput.vue"
import axios from "axios"

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)
app.use(router)

app.component("Presence", Presence)
app.component("Motion", Motion)
app.component("AbstractButton", AbstractButton)
app.component("TextButton", TextButton)
app.component("Throbber", Throbber)
app.component("FormInput", FormInput)

const api = axios.create({
  baseURL: "http://localhost:80/api", //move to env
})

app.config.globalProperties.$http = api
app.mount("#app")

export default api
