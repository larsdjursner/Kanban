<template>
  <Modal :showModal="showModal" @closeModal="cancel">
    <template #header>
      {{ editing ? "Edit board" : "Create new board" }}
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
      <div class="flex flex-row justify-between px-4 pb-4 gap-4">
        <AbstractButton
          v-if="editing"
          class="px-4 py-2"
          @click="showDelete = true"
        >
          Delete
        </AbstractButton>

        <span class="flex-1" />
        <AbstractButton class="px-4 py-2" @click="cancel">
          Cancel
        </AbstractButton>

        <AbstractButton class="px-4 py-2" @click="submit">
          {{ editing ? "Update" : "Create" }}
        </AbstractButton>
      </div>
    </template>
  </Modal>

  <ConfirmationModal
    v-if="showConfirmation"
    message="Do you want to discard your changes?"
    confirmation="Discard"
    :show-dialog="showConfirmation"
    @closeDialog="showConfirmation = false"
    @confirm="reset"
  />

  <ConfirmationModal
    v-if="showDelete"
    message="Are you sure you want to delete this board?"
    confirmation="Delete"
    :show-dialog="showDelete"
    @closeDialog="showConfirmation = false"
    @confirm="deleteBoard"
  />
</template>

<script>
import Modal from "../../components/modals/Modal.vue"
import ConfirmationModal from "../../components/modals/ConfirmationModal.vue"
import FormInput from "../../components/form/FormInput.vue"
import { useStore } from "../../stores/store"

export default {
  components: { Modal, ConfirmationModal, FormInput },

  props: {
    editing: { type: Boolean, default: false },
    showModal: { type: Boolean, default: false },
  },

  emits: ["closeModal", "scrollToBoard"],

  data: () => ({
    store: useStore(),

    board: {
      name: "",
      description: "",
    },

    changed: false,

    showConfirmation: false,
    showDelete: false,
  }),

  async created() {
    if (this.editing) {
      this.board = { ...this.store.currentBoard }
    }

    const initialWatch = this.$watch(
      () => this.board,
      () => {
        this.changed = true

        // Destroy watcher after inital registration
        initialWatch()
      },
      { deep: true }
    )
  },

  methods: {
    closeModal() {
      this.board = {
        name: "",
        description: "",
      }
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

    submit() {
      if (this.editing) {
        this.updateBoard()
        return
      }

      this.addBoard()
    },

    async addBoard() {
      await this.$http
        .post("/boards", this.board)
        .then(({ data }) => {
          this.store.addBoard(data)

          this.closeModal()
          this.$emit("scrollToBoard", data)
        })
        .catch((err) => console.log(err))
    },

    async updateBoard() {
      const { id } = this.board

      await this.$http.put(`/boards/${id}`, this.board).then(({ data }) => {
        this.store.updateBoard(id, data)
        this.closeModal()
      })
    },

    async deleteBoard() {
      const { id } = this.board
      await this.$http.delete(`/boards/${id}`).then(() => {
        this.store.deleteBoardById(id)
        this.closeModal()

        const boardToNavigateTo = this.store.getFirstBoard

        if (boardToNavigateTo) {
          this.$router.replace({
            name: "board",
            params: { id: boardToNavigateTo.id },
          })
        } else {
          this.$router.push("/boards")
        }
      })
    },
  },
}
</script>