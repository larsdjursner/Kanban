<template>
  <div class="relative" @click="open = !open">
    <slot name="button" />
    <Presence>
      <Motion
        v-show="open"
        :initial="{ opacity: 0 }"
        :animate="{ opacity: 1 }"
        :exit="{ opacity: 0 }"
      >
        <div
          class="absolute bg-white top-9 right-4 rounded-md border"
          @click.stop
        >
          <ul ref="list" class="flex flex-col w-full">
            <slot name="menu" />
          </ul>
        </div>
      </Motion>
    </Presence>
  </div>
</template>

<script>
export default {
  data: () => ({
    open: false,
  }),

  // methods: {
  //   handleOpen() {
  //     const list = this.$refs["list"]

  //     animate(list, { opacity: [0, 1] })

  //     this.open = !this.open
  //   },
  // },
}
</script>
