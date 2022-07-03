import { createApp } from "vue"
import { createPinia } from "pinia"
import App from "./App.vue"
import router from "./router"
import "./index.css"
import { Presence, Motion } from "@motionone/vue"
import AbstractButton from "./components/AbstractButton.vue"

const pinia = createPinia()
const app = createApp(App)

app.component("Presence", Presence)
app.component("Motion", Motion)
app.component("AbstractButton", AbstractButton)

app.use(pinia)
app.use(router)
app.mount("#app")
