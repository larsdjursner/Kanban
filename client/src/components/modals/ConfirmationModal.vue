<template>
  <DialogModal :show-dialog="showDialog" @closeDialog="$emit('closeDialog')">
    <template #header> {{ message }}</template>

    <template #footer>
      <div class="flex-row justify-end">
        <AbstractButton class="py-2 px-4 m-2" @click="closeDialog"
          >Cancel</AbstractButton
        >
        <AbstractButton class="py-2 px-4 m-2" @click="discardChanges"
          >Discard</AbstractButton
        >
      </div>
    </template>
  </DialogModal>
</template>
<script>
import AbstractButton from "../AbstractButton.vue"
import DialogModal from "./Dialog.vue"

export default {
  components: { AbstractButton, DialogModal },

  props: {
    message: {
      type: String,
      default: "Are you sure?",
    },

    showDialog: {
      type: Boolean,
      default: false,
    },
  },

  emits: ["closeDialog", "discardChanges"],

  methods: {
    closeDialog() {
      this.$emit("closeDialog")
    },

    discardChanges() {
      this.$emit("discardChanges")
    },
  },
}
</script>
