<template>
  <div class="max-w-screen max-h-screen w-screen h-screen flex bg-slate-700">
    <BoardModal
      :show-modal="showModal"
      @closeModal="showModal = false"
      @addBoard="(board) => addBoard(board)"
    />
    <Drawer>
      <template #header>
        <p class="w-full h-full text-2xl font-bold px-6">Kanban</p>
      </template>

      <template #content>
        <div class="flex flex-col h-full">
          <p class="self-center text-sm">
            {{ `All boards ( ${store.getBoardAmount} )` }}
          </p>

          <ul
            ref="list"
            class="h-full overflow-y-scroll overflow-x-hidden scrollbar-dark dark:scrollbar flex flex-col py-2 pr-2 my-2 rounded-xl bg-slate-600"
          >
            <BoardListItem
              v-for="board in store.getBoards"
              :key="'board-' + board.id"
              :ref="'board-' + board.id"
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
import Drawer from "../components/Drawer.vue"
import BoardListItem from "../components/BoardListItem.vue"
import { useStore } from "../stores/store"
import Navbar from "../components/Navbar.vue"
import Block from "../components/Block.vue"
import BoardModal from "../components/modals/BoardModal.vue"
import { animate, stagger } from "motion"
import NewBoard from "../components/NewBoard.vue"
import BoardContent from "../components/BoardContent.vue"

export default {
  components: {
    Drawer,
    BoardListItem,
    Navbar,
    Block,
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
    // this.store.setCurrentBoard(this.$route.params.id)
  },

  mounted() {
    // this.appendAnimations()
    // this.scrollToBoard(this.$route.params.id)

    this.$watch(
      () => this.$route.params,
      ({ id }) => {
        this.store.setCurrentBoard(id)
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

    async fetchBoard() {
      await this.$http
        .get(`/boards/${this.$route.params.id}`)
        .then(({ data }) => {
          this.store.setCurrentBoard(data)
        })
    },

    async addBoard(board) {
      await this.$http
        .post("/boards", board)
        .then(({ data }) => {
          this.store.addBoard(data)
          this.$router.replace({ name: "board", params: data.id })
          this.$nextTick(() => this.scrollToBoard(data.id))
        })
        .catch((err) => console.log(err))
    },

    appendAnimations() {
      const { list } = this.$refs

      animate(list, { opacity: [0, 1] }, { delay: 0.3 })
      animate(list.children, { opacity: [0, 0.2, 1] }, { delay: stagger(0.1) })
    },

    scrollToBoard(id) {
      console.log(this.$refs["board-" + id][0].$el)
      // const el = this.$refs["board-" + id][0].$el
      // el.scrollIntoView({ behavior: "smooth" })
    },
  },
}
</script>
