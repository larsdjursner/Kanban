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

    <div class="flex flex-col flex-1 max-h-full max-w-full w-full h-full">
      <Navbar />

      <div class="h-full w-full overflox-x-scroll">
        <div class="p-4 h-full w-full bg-slate-500">content</div>
        <!-- <Block /> -->
      </div>
    </div>
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

export default {
  components: {
    Drawer,
    BoardListItem,
    Navbar,
    Block,
    BoardModal,
    NewBoard,
  },

  data: () => ({
    store: useStore(),
    showModal: false,
  }),

  created() {
    this.store.fetchBoards()
    this.store.setCurrentBoard(this.$route.params.id)
  },

  mounted() {
    this.appendAnimations()
    this.scrollToBoard(this.$route.params.id)

    this.$watch(
      () => this.$route.params,
      ({ id }) => {
        this.store.setCurrentBoard(id)
        this.scrollToBoard(id)
      }
    )
  },

  methods: {
    addBoard(board) {
      // implement proper validation
      if (board.title.length === 0) {
        return
      }

      const { id } = this.store.addBoard(board)

      this.$router.replace({ name: "board", params: { id } })
    },

    appendAnimations() {
      const { list } = this.$refs

      animate(list, { opacity: [0, 1] }, { delay: 0.3 })
      animate(list.children, { opacity: [0, 0.2, 1] }, { delay: stagger(0.1) })
    },

    scrollToBoard(id) {
      // window.HTMLElement.prototype.scrollIntoView = function () {}
      const el = this.$refs["board-" + id]
      // console.log(el[0].$el)
      el[0].$el.scrollIntoView({ behavior: "smooth" })
      // this.$nextTick(() => el.$el.scrollIntoView())

      // el?.scrollIntoView({ behavior: "smooth" })
    },
  },
}
</script>
