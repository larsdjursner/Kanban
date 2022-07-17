<template>
  <div class="flex flex-col flex-1 max-h-full max-w-full w-full h-full">
    <Navbar />

    <div class="h-full w-full overflox-x-scroll">
      <div v-if="currentBoard" class="p-4 h-full w-full">
        <p>{{ currentBoard.name }}</p>
        <p>{{ currentBoard.description }}</p>
      </div>
      <!-- <Block /> -->
    </div>
  </div>
</template>

<script>
import { useStore } from "../stores/store"
import Navbar from "./Navbar.vue"

export default {
  components: { Navbar },

  props: {
    id: { type: Number, required: true },
  },

  data: () => ({
    store: useStore(),
  }),

  computed: {
    currentBoard() {
      return this.store.currentBoard
    },
  },

  // async created() {
  //   await this.fetchBoard()

  //   this.$watch(
  //     () => this.id,
  //     () => {
  //       this.fetchBoard()
  //     }
  //   )
  // },

  // methods: {
  //   async fetchBoard() {
  //     await this.$http
  //       .get(`/boards/${this.id}`)
  //       .then(({ data }) => (this.board = data))
  //   },
  // },
}
</script>
