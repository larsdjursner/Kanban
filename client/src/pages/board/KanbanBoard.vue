<template>
  <div class="max-w-screen max-h-screen w-screen h-screen flex">
    <BoardModal
      v-if="showModal"
      :showModal="showModal"
      :editing="editing"
      @closeModal="closeModal"
      @navigateToBoard="(board) => navigateToBoard(board)"
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
            v-if="store.getBoards"
            ref="list"
            class="h-full overflow-y-scroll overflow-x-hidden scrollbar flex flex-col my-2 rounded-md shadow-lg"
          >
            <BoardListItem
              v-for="board in store.getBoards"
              :key="`board-${board.id}`"
              :ref="`board-${board.id}`"
              :board="board"
            />
          </ul>

          <NewBoard @showModal="showCreateModal" />
        </div>
      </template>
    </Drawer>

    <div class="flex flex-col flex-1 max-h-full max-w-full w-full h-full">
      <Navbar @showModal="showEditModal" />
      <BoardContent :id="parseInt($route.params.id)" />
    </div>
  </div>
</template>

<script>
import { useStore } from "../../stores/store"
import { animate, stagger } from "motion"

import Drawer from "../../components/menu/Drawer.vue"
import Navbar from "../../components/Navbar.vue"

import NewBoard from "../../components/NewBoard.vue"
import BoardModal from "./BoardModal.vue"

import BoardContent from "./BoardContent.vue"
import BoardListItem from "./BoardListItem.vue"

export default {
  components: {
    Drawer,
    BoardListItem,
    Navbar,
    BoardModal,
    NewBoard,
    BoardContent,
  },

  async beforeRouteUpdate(to) {
    await this.fetchBoard(to.params.id)
  },

  data: () => ({
    store: useStore(),
    showModal: false,
    editing: false,
  }),

  async created() {
    await this.fetchBoard()
    await this.fetchBoards()
  },

  mounted() {
    this.appendAnimations()
    // this.scrollToBoard(this.$route.params.id)
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

    navigateToBoard(id) {
      this.$router.replace({ name: "board", params: { id } })
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

    showEditModal() {
      this.showModal = true
      this.editing = true
    },

    showCreateModal() {
      this.showModal = true
    },

    closeModal() {
      this.showModal = false
      this.editing = false
    },
  },
}
</script>
