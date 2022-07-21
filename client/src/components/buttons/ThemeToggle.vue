<template>
  <!-- <label
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
  </label> -->

  <div
    class="flex rounded-md border justify-center self-center gap-4 py-2 px-8"
  >
    <SunIcon class="w-5 h-5" />
    <label
      for="default-toggle"
      class="inline-flex relative items-center cursor-pointer"
    >
      <input
        id="default-toggle"
        type="checkbox"
        :value="theme.darkMode"
        class="sr-only peer"
      />
      <div
        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
      ></div>
    </label>
    <MoonIcon class="w-5 h-5" />
  </div>
</template>

<script>
import { useThemeStore } from "../../stores/theme"
import { SunIcon, MoonIcon } from "@heroicons/vue/outline"
// import { animate } from "motion"

export default {
  components: { SunIcon, MoonIcon },

  data: () => ({
    theme: useThemeStore(),
  }),

  methods: {
    // handleClick() {
    //   if (this.theme.darkMode) {
    //     animate(this.$refs.moon, { opacity: 0, duration: 2 })
    //   } else {
    //     animate(this.$refs.sun, { opacity: 0, duration: 2 })
    //   }
    //   this.$emit("click")
    // },
  },
}
</script>

<style></style>
