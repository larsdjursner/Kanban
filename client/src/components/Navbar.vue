<template>
  <div
    class="w-full max h-14 border-b-2 p-2 flex items-baseline justify-between bg-slate-700"
  >
    <p class="text-xl font-semibold text-slate-300">
      {{}}
    </p>
    <!-- <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden"
      >Open drawer</label
    > -->
    <input
      type="checkbox"
      class="toggle"
      :checked="themeStore.darkMode"
      @change="themeStore.toggleTheme"
    />
  </div>
</template>

<script>
import { useStore } from "../stores/store"
import { useThemeStore } from "../stores/theme"

export default {
  data: () => ({
    themeStore: useThemeStore(),
    store: useStore(),
    currentBoard: null,
  }),

  computed: {
    id() {
      return this.$route.params.id
    },
  },

  // async created() {
  //   this.fetch()
  // },
  // // async updated() {
  // //   this.fetch()
  // // },

  // methods: {
  //   async fetch() {
  //     await this.$http
  //       .get(`/boards/${this.id}`)
  //       .then(({ data }) => (this.currentBoard = data))
  //   },
  // },
}
</script>
