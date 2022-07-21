<template>
  <BoardModal
    v-if="showModal"
    :showModal="showModal"
    @closeModal="showModal = false"
    @navigateToBoard="navigateToBoardById($event)"
  />

  <Navbar />
  <div class="flex flex-col justify-center items-center w-screen h-screen">
    <p>{{ "Create a Kanban board to organize your work!" }}</p>

    <NewBoard @showModal="showModal = true" />
  </div>
</template>

<script>
import BoardModal from "../board/BoardModal.vue"
import NewBoard from "../../components/NewBoard.vue"
import Navbar from "../../components/Navbar.vue"
import { useStore } from "../../stores/store"

export default {
  components: { BoardModal, NewBoard, Navbar },

  data: () => ({
    showModal: false,
    store: useStore(),
  }),

  async created() {
    await this.fetchBoards()

    if (this.store.getBoardAmount > 0) {
      const { id } = this.store.getFirstBoard
      this.$router.push({ name: "board", params: { id } })
    }
  },

  methods: {
    async fetchBoards() {
      await this.$http.get("/boards").then(({ data }) => {
        this.store.setBoards(data)
      })
    },

    navigateToBoardById(id) {
      this.$router.push({ name: "board", params: id })
    },
  },
}
</script>
