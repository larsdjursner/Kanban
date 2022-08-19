<template>
  <TextButton @click="click">
    <p class="">
      {{ "Create new board" }}
    </p>
  </TextButton>
</template>

<script>
import { animate } from "motion"
import TextButton from "./buttons/TextButton.vue"

export default {
  components: { TextButton },
  emits: ["showModal"],
  methods: {
    click() {
      animate(this.$refs.btn, { scale: [1, 1.1, 1] })
      this.$emit("showModal")
    },
  },
}
</script>
