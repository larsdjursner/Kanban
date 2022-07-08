<template>
  <label
    for="default-toggle"
    class="inline-flex relative items-center cursor-pointer"
    @click="handleClick"
  >
    <input :modelValue="checked" type="checkbox" class="sr-only peer" />
    <div class="bg-gray-200 w-12 h-6 rounded-full">
      <SunIcon
        v-if="!theme.darkMode"
        ref="sun"
        class="w-5 h-5 absolute right-1 top-0.5"
      />
      <MoonIcon v-else ref="moon" class="w-5 h-5 absolute left-1 top-0.5" />
    </div>
  </label>
</template>

<script>
import { useThemeStore } from "../../stores/theme"
import { SunIcon, MoonIcon } from "@heroicons/vue/outline"
import { animate } from "motion"

export default {
  components: { SunIcon, MoonIcon },

  props: {
    checked: {
      type: Boolean,
      required: true,
    },
  },

  emits: ["click"],

  data: () => ({
    theme: useThemeStore(),
  }),

  methods: {
    handleClick() {
      if (this.theme.darkMode) {
        animate(this.$refs.moon, { opacity: 0, duration: 2 })
      } else {
        animate(this.$refs.sun, { opacity: 0, duration: 2 })
      }

      this.$emit("click")
    },
  },
}
</script>

<style></style>
