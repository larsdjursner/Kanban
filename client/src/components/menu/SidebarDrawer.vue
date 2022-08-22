<template>
  <div class="h-full w-full flex overflow-hidden">
    <!-- sidebar -->
    <div
      v-show="open"
      ref="drawer"
      class="w-1/4 h-full max-h-full bg-slate-50 flex flex-col shadow-lg gap-4"
    >
      <!-- header -->
      <div class="w-full">
        <slot name="header" />
      </div>

      <!-- content -->
      <div class="w-full max-h-[60%]">
        <slot name="content" />
      </div>

      <!-- buttons -->
      <div class="w-full flex flex-col items-center">
        <slot name="buttons" />
        <TextButton @click="closeDrawer">
          <div class="flex gap-6 items-center">
            <p>Hide Menu</p>
            <EyeOffIcon class="h-4 w-4" />
          </div>
        </TextButton>
      </div>
    </div>

    <!-- body -->
    <div
      ref="body"
      class="h-full p-2 pb-8 pl-10 relative flex flex-col"
      :class="open ? 'w-3/4' : 'w-full'"
    >
      <div class="absolute top-2 left-2 flex flex-col gap-2">
        <slot name="bodyOptions" />

        <button v-if="!open" class="h-6 w-6" @click="openDrawer">
          <EyeIcon class="h-full w-full hover:text-slate-500" />
        </button>
      </div>

      <slot name="body" />
    </div>
  </div>
</template>

<script>
import ThemeToggle from "../buttons/ThemeToggle.vue"
import { EyeOffIcon, EyeIcon } from "@heroicons/vue/outline"
import TextButton from "../buttons/TextButton.vue"
import { animate } from "motion"

export default {
  components: { ThemeToggle, EyeOffIcon, TextButton, EyeIcon },

  data: () => ({
    open: true,
  }),

  methods: {
    openDrawer() {
      const { drawer, body } = this.$refs

      // const { left } = body.getBoundingClientRect()
      // const { right } = drawer.getBoundingClientRect()

      animate(drawer, { x: [-280, 0] }, { duration: 0.5 })
      animate(body, { x: [-280, 0] }, { duration: 0.5 })

      this.open = true
    },

    closeDrawer() {
      const { drawer, body } = this.$refs

      const { left } = body.getBoundingClientRect()
      const { right } = drawer.getBoundingClientRect()

      animate(drawer, { x: [right, 0] }, { duration: 0.5 })
      animate(body, { x: [left, 0] }, { duration: 0.5 })

      this.open = false
    },
  },
}
</script>
