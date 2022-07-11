<template>
  <Presence>
    <Motion
      v-show="open"
      :initial="{ opacity: 0, x: -50 }"
      :animate="{
        opacity: 1,
        x: 0,
        transition: { delay: 0.2 },
      }"
      :exit="{ opacity: 0, x: -50 }"
    >
      <div class="flex h-full z-0">
        <div class="flex flex-col w-72 h-full py-6 pr-1 gap-4">
          <!-- title -->
          <div class="w-full">
            <slot name="header" />
          </div>

          <!-- content -->
          <div class="w-full h-3/4">
            <slot name="content" />
          </div>

          <ThemeToggle />

          <div class="w-full flex justify-center">
            <TextButton class="flex items-center gap-4" @click="toggleDrawer">
              <p>{{ "Hide Sidebar" }}</p>
              <EyeOffIcon class="h-5 w-5" />
            </TextButton>
          </div>
        </div>
        <div
          class="h-full bg-slate-300 hover:bg-slate-200 w-2 cursor-pointer"
          @click="toggleDrawer"
        />
      </div>
    </Motion>
  </Presence>

  <Presence>
    <!-- Something buggy with the first activation -->
    <Motion
      v-show="!open"
      :initial="{
        opacity: 0,
        x: -200,
        transition: { duration: 0 },
      }"
      :animate="{
        opacity: 1,
        x: 0,
        transition: { delay: 0.4 },
      }"
      :exit="{
        opacity: 0,
        x: -200,
        transition: { duration: 0 },
      }"
    >
      <div
        class="h-full bg-slate-300 hover:bg-slate-200 w-2 cursor-pointer"
        @click="toggleDrawer"
      />
    </Motion>
  </Presence>
</template>

<script>
import ThemeToggle from "./buttons/ThemeToggle.vue"
import { EyeOffIcon } from "@heroicons/vue/outline"

export default {
  components: { ThemeToggle, EyeOffIcon },
  data: () => ({
    open: true,
  }),
  methods: {
    toggleDrawer() {
      this.open = !this.open
    },
  },
}
</script>
