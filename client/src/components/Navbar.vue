<template>
  <div
    class="w-full max h-14 border-b-2 p-2 flex items-baseline justify-between"
  >
    <p class="text-xl font-semibold">{{}}</p>
    <!-- <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden"
      >Open drawer</label
    > -->
    <input
      type="checkbox"
      class="toggle"
      :checked="themeStore.darkMode"
      @change="themeStore.toggleTheme"
    />

    <TextButton @click="logout"> {{ "Log out" }}</TextButton>
  </div>
</template>

<script>
import { useAuth } from "../stores/auth"
import { useStore } from "../stores/store"
import { useThemeStore } from "../stores/theme"
import TextButton from "./buttons/TextButton.vue"

export default {
  components: { TextButton },
  data: () => ({
    themeStore: useThemeStore(),
    store: useStore(),
    auth: useAuth(),
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
