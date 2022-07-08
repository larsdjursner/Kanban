<template>
  <BoardModal
    :show-modal="showModal"
    @closeModal="showModal = false"
    @addBoard="(board) => addBoard(board)"
  />
  <div class="flex">
    <ul class="flex flex-col">
      <li v-for="board in store.getBoards" :key="'board-' + board.id">
        <router-link :to="`/boards/${board.id}`">
          {{ board.name }}
        </router-link>
      </li>
    </ul>

    <NewBoard @addBoard="showModal = true" />
  </div>
</template>

<script>
import BoardModal from "../components/modals/BoardModal.vue"
import { useStore } from "../stores/store"
import NewBoard from "../components/NewBoard.vue"

export default {
  components: { BoardModal, NewBoard },

  data: () => ({
    showModal: false,
    store: useStore(),
  }),

  created() {
    this.fetchBoards()
  },

  methods: {
    async fetchBoards() {
      await this.$http.get("/boards").then(({ data }) => {
        this.store.setBoards(data)
      })
    },
    async addBoard(board) {
      await this.$http
        .post("/boards", board)
        .then(({ data }) => {
          this.store.addBoard(data)
          const { id } = data
          this.$router.replace({ name: "board", params: { id } })
        })
        .catch((err) => console.log(err))
    },
  },
}
</script>
