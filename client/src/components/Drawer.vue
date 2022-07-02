<template>
  <Presence>
    <Motion
      v-show="open"
      :initial="{ opacity: 0, x: 50 }"
      :animate="{
        opacity: 1,
        x: 0,
        transition: { delay: 0.2 },
      }"
      :exit="{ opacity: 0, x: -50 }"
    >
      <div class="flex h-full z-0">
        <div
          class="flex flex-col w-72 h-full py-6 px-4 divide-y-2 gap-4 bg-white"
        >
          <!-- title -->
          <div class="w-full">
            <slot name="header" />
          </div>

          <!-- add content button -->
          <div class="w-full">
            <slot name="button" />
          </div>

          <!-- content -->
          <div class="w-full h-3/4">
            <slot name="content" />
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
    <Motion
      v-show="!open"
      :initial="{ opacity: 0 }"
      :animate="{
        opacity: 1,
        transition: { delay: 0.2 },
      }"
      :exit="{ opacity: 0 }"
    >
      <div
        class="fixed left-0 only-of-type:h-full bg-slate-300 hover:bg-slate-200 w-2 cursor-pointer"
        @click="toggleDrawer"
      />
    </Motion>
  </Presence>
</template>

<script>
import { Presence, Motion } from "@motionone/vue"

export default {
  components: { Presence, Motion },
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
