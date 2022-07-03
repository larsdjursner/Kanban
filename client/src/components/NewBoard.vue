<template>
  <button ref="btn" class="px-6" @click="click">
    <p class="font-semibold text-slate-300">
      {{ "Create new board" }}
    </p>
  </button>
</template>

<script>
import { animate } from "motion"

export default {
  emits: ["addBoard"],

  methods: {
    click() {
      animate(this.$refs.btn, { scale: [1, 1.1, 1] })

      this.$emit("addBoard")
    },
  },
}
</script>
