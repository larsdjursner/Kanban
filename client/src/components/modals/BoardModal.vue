<template>
  <Modal :show-modal="showModal" @closeModal="cancel">
    <template #header>
      {{ "Create new board" }}
    </template>
    <template #content>
      <div class="flex flex-col gap-8 mx-4 my-8">
        <FormInput
          v-model="board.name"
          text="Board name"
          placeholder="Enter a board name..."
          required
        />

        <FormInput
          v-model="board.description"
          text="Board description"
          placeholder="Enter an optional description..."
        />
      </div>
    </template>

    <template #footer>
      <div class="flex flex-row justify-end px-4 py-2 gap-4">
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
import AbstractButton from "../buttons/AbstractButton.vue"
import ConfirmationModal from "./ConfirmationModal.vue"
import FormInput from "../form/FormInput.vue"

export default {
  components: { Modal, AbstractButton, ConfirmationModal, FormInput },

  props: {
    showModal: { type: Boolean, default: false },
  },

  emits: ["closeModal", "addBoard"],

  data: () => ({
    board: {
      name: "",
      description: "",
    },
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
