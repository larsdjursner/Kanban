<template>
  <DialogModal :show-dialog="showDialog" @closeDialog="$emit('closeDialog')">
    <template #header> {{ message }}</template>

    <template #footer>
      <div class="flex-row w-full justify-end">
        <AbstractButton class="py-2 px-4 m-2" @click="closeDialog"
          >Cancel</AbstractButton
        >
        <AbstractButton class="py-2 px-4 m-2" @click="confirm">{{
          confirmation
        }}</AbstractButton>
      </div>
    </template>
  </DialogModal>
</template>
<script>
import AbstractButton from "../buttons/AbstractButton.vue"
import DialogModal from "./Dialog.vue"

export default {
  components: { AbstractButton, DialogModal },

  props: {
    message: {
      type: String,
      default: "Are you sure?",
    },

    confirmation: {
      type: String,
      default: "Accept",
    },

    showDialog: {
      type: Boolean,
      default: false,
    },
  },

  emits: ["closeDialog", "confirm"],

  methods: {
    closeDialog() {
      this.$emit("closeDialog")
    },

    confirm() {
      this.$emit("confirm")
    },
  },
}
</script>
