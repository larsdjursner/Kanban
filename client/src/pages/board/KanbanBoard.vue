<template>
  <div class="max-w-screen max-h-screen w-screen h-screen flex">
    <BoardModal
      :show-modal="showModal"
      @closeModal="showModal = false"
      @addedBoard="handleAddedBoard"
    />
    <Drawer>
      <template #header>
        <p class="w-full h-full text-2xl font-bold px-6">Kanban</p>
      </template>

      <template #content>
        <div class="flex flex-col h-full">
          <div class="w-full flex justify-center border-y py-2">
            <p class="text-sm">
              {{ `All boards ( ${store.getBoardAmount} )` }}
            </p>
          </div>

          <ul
            ref="list"
            class="h-full overflow-y-scroll overflow-x-hidden scrollbar flex flex-col py-2 pr-4 my-2 rounded-md shadow-lg"
          >
            <BoardListItem
              v-for="board in store.getBoards"
              :key="`board-${board.id}`"
              :ref="`board-${board.id}`"
              :board="board"
            />
          </ul>

          <NewBoard @addBoard="showModal = true" />
        </div>
      </template>
    </Drawer>

    <BoardContent :id="parseInt($route.params.id)" />
  </div>
</template>

<script>
import { useStore } from "../../stores/store"
import { animate, stagger } from "motion"

import Drawer from "../../components/Drawer.vue"
import Navbar from "../../components/Navbar.vue"

import NewBoard from "../../components/NewBoard.vue"
import BoardModal from "../../components/modals/BoardModal.vue"
import BoardContent from "../../components/BoardContent.vue"
import BoardListItem from "../../components/BoardListItem.vue"

export default {
  components: {
    Drawer,
    BoardListItem,
    Navbar,
    BoardModal,
    NewBoard,
    BoardContent,
  },

  data: () => ({
    store: useStore(),
    showModal: false,
  }),

  async created() {
    await this.fetchBoard()
    await this.fetchBoards()
  },

  mounted() {
    this.appendAnimations()
    // this.scrollToBoard(this.$route.params.id)

    this.$watch(
      () => this.$route.params,
      ({ id }) => {
        this.fetchBoard(id)
      }
    )
  },

  methods: {
    async fetchBoards() {
      await this.$http.get("/boards").then(({ data }) => {
        this.store.setBoards(data)
        this.appendAnimations()
      })
    },

    async fetchBoard(id = this.$route.params.id) {
      await this.$http.get(`/boards/${id}`).then(({ data }) => {
        this.store.setCurrentBoard(data)
      })
    },

    handleAddedBoard(board) {
      this.$router.replace({ name: "board", params: board.id })
      // this.$nextTick(() => this.scrollToBoard(board.id))
    },

    appendAnimations() {
      const { list } = this.$refs

      animate(
        list.children,
        { opacity: [0, 1] },
        { delay: stagger(0.1, { start: 0.3 }) }
      )
    },

    // scrollToBoard(id) {
    // const key = `board-${id}`
    // const el = this.$refs["board-" + id][0].$el
    // el.scrollIntoView({ behavior: "smooth" })
    // },
  },
}
</script>
