<template>
  <div class="w-full h-full flex gap-2 items-center">
    <img
      v-if="logo"
      :src="logo"
      alt="Kanban"
      class="h-6 w-6"
    />
    <p :class="large ? 'text-2xl font-bold' : 'text-xl font-semibold'">Kanban</p>
  </div>
</template>

<script>
export default {
  props: {
    large: { type: Boolean, default: false },
  },

  data: () => ({
    logo: null,
  }),

  created() {
    const logo = import.meta.globEager("@/assets/nav/logo.svg")

    this.logo = new URL(Object.keys(logo), import.meta.url).href
  },
}
</script>

<style></style>
