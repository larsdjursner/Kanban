<template>
  <Modal :show-modal="showModal" @closeModal="closeModal">
    <template #header>
      {{ "Create new board" }}
    </template>
    <template #content>
      <div class="flex justify-between items-baseline px-4 py-8">
        <p class="font-semibold text-md">Board name:</p>
        <input
          v-model="board.title"
          class="bg-slate-300 w-3/4 h-10 rounded-lg"
        />
      </div>
    </template>

    <template #footer>
      <div class="flex flex-row justify-end bg-slate-600 px-4 py-2">
        <AbstractButton> Cancel </AbstractButton>

        <AbstractButton @click="addBoard"> Create </AbstractButton>
      </div>
    </template>
  </Modal>
</template>

<script>
import Modal from "./Modal.vue"
import AbstractButton from "../AbstractButton.vue"

export default {
  components: { Modal, AbstractButton },

  props: {
    showModal: { type: Boolean, default: false },
    // board: { type: Object, required: false },
  },

  emits: ["closeModal", "addBoard"],

  data: () => ({
    board: {},
  }),

  methods: {
    closeModal() {
      this.$emit("closeModal")
    },

    addBoard() {
      this.closeModal()

      this.$emit("addBoard", this.board)
    },
  },
}
</script>
