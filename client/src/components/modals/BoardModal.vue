<template>
  <Modal :show-modal="showModal" @closeModal="cancel">
    <template #header>
      {{ "Create new board" }}
    </template>
    <template #content>
      <div class="flex justify-between items-baseline px-4 py-8">
        <p class="font-semibold text-md">Board name</p>
        <input
          v-model="board.name"
          class="bg-slate-300 w-3/4 h-10 rounded-lg py-2 px-6"
          placeholder="Enter a board name..."
        />
      </div>
    </template>

    <template #footer>
      <div class="flex flex-row justify-end bg-slate-600 px-4 py-2 gap-4">
        <AbstractButton class="px-4 py-2" @click="cancel">
          Cancel
        </AbstractButton>

        <AbstractButton class="px-4 py-2" @click="addBoard">
          Create
        </AbstractButton>
      </div>
    </template>
  </Modal>

  <ConfirmationModal
    :show-dialog="showConfirmation"
    :message="'Are you really really sure'"
    @closeDialog="showConfirmation = false"
    @discardChanges="reset"
  />
</template>

<script>
import Modal from "./Modal.vue"
import AbstractButton from "../AbstractButton.vue"
import ConfirmationModal from "./ConfirmationModal.vue"

export default {
  components: { Modal, AbstractButton, ConfirmationModal },

  props: {
    showModal: { type: Boolean, default: false },
  },

  emits: ["closeModal", "addBoard"],

  data: () => ({
    board: {},
    changed: false,
    showConfirmation: false,
  }),

  created() {
    const changeWatcher = this.$watch(
      () => this.board,
      () => {
        this.changed = true

        // Destroy watcher after inital registration
        changeWatcher()
      },
      { deep: true }
    )
  },

  methods: {
    closeModal() {
      // clean up
      this.board = {}
      this.showConfirmation = false
      this.changed = false

      this.$emit("closeModal")
    },

    cancel() {
      if (this.changed) {
        this.showConfirmation = true
        return
      }
      this.closeModal()
    },

    reset() {
      this.closeModal()
    },

    addBoard() {
      this.$emit("addBoard", this.board)

      this.closeModal()
    },
  },
}
</script>
