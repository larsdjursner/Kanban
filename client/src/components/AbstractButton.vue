<template>
  <button
    ref="btn"
    class="bg-slate-200 hover:bg-slate-100 focus:bg-slate-200 rounded-lg border"
    @click="click"
  >
    <slot />
  </button>
</template>

<script>
import { animate } from "motion"
export default {
  emits: ["handleClick"],

  methods: {
    click() {
      animate(this.$refs.btn, { scale: [1, 1.1, 1] })
      this.$emit("handleClick")
    },
  },
}
</script>
