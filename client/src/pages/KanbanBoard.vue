<template>
  <div class="max-w-screen max-h-screen w-screen h-screen flex">
    <Modal :show-modal="showModal" @closeModal="showModal = false">
      <template #content> </template>
    </Modal>

    <Drawer>
      <template #header>
        <p class="w-full h-full text-2xl font-bold">Kanban Board</p>
      </template>

      <template #button>
        <div class="w-full h-10 flex justify-center pt-2">
          <button
            class="font-bold text-lg bg-teal-400 hover:bg-teal-300 focus:bg-teal-300 rounded-lg border px-2"
            @click="showModal = true"
          >
            Add board
          </button>
        </div>
      </template>
      <template #content>
        <ul class="h-full overflow-y-scroll scrollbar flex flex-col">
          <BoardListItem
            v-for="board in store.getBoards"
            :key="board.id"
            :board="board"
            :is-current-board="store.getCurrentBoard.id === board.id"
          />
        </ul>
      </template>
    </Drawer>

    <div class="flex flex-col flex-1 max-h-full max-w-full w-full h-full">
      <Navbar />

      <div class="p-4 h-full w-full overflox-x-scroll">
        <!-- <Block /> -->
      </div>
    </div>

    <!-- Main content -->
  </div>
</template>

<script>
import Drawer from "../components/Drawer.vue"
import BoardListItem from "../components/BoardListItem.vue"
import { useStore } from "../stores/store"
import Navbar from "../components/Navbar.vue"
import Block from "../components/Block.vue"
import Modal from "../components/Modal.vue"

export default {
  components: {
    Drawer,
    BoardListItem,
    Navbar,
    Block,
    Modal,
  },

  data: () => ({
    store: useStore(),
    showModal: false,
  }),

  created() {
    this.store.fetchBoards()
    this.store.setCurrentBoard(this.$route.params.id)

    this.$watch(
      () => this.$route.params,
      ({ id }) => {
        this.store.setCurrentBoard(id)
      }
    )
  },

  methods: {
    addBoard() {
      // activate modal to create board
      // some smooth transition into view
    },
  },
}
</script>
