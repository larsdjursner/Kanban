<template>
  <button ref="btn" class="px-6" @click="click">
    <p class="font-semibold">
      {{ "Create new board" }}
    </p>
  </button>
</template>

<script>
import { animate } from "motion"

export default {
  emits: ["showModal"],

  methods: {
    click() {
      animate(this.$refs.btn, { scale: [1, 1.1, 1] })

      this.$emit("showModal")
    },
  },
}
</script>
