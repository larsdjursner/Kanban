<template>
  <div
    class="w-full max h-14 border-b-2 p-2 flex items-baseline justify-between"
  >
    <p class="text-xl font-semibold">{{}}</p>
    <Toggle :checked="theme.darkMode" @click="theme.toggleTheme" />

    <TextButton @click="logout"> {{ "Log out" }}</TextButton>
  </div>
</template>

<script>
import { useAuth } from "../stores/auth"
import { useStore } from "../stores/store"
import { useThemeStore } from "../stores/theme"
import TextButton from "./buttons/TextButton.vue"
import Toggle from "./buttons/ThemeToggle.vue"

export default {
  components: { TextButton, Toggle },
  data: () => ({
    store: useStore(),
    auth: useAuth(),
    theme: useThemeStore(),
    currentBoard: null,
  }),
  computed: {
    id() {
      return this.$route.params.id
    },
  },

  methods: {
    logout() {
      this.auth.logout()
      this.$router.replace("/")
    },
  },
}
</script>
