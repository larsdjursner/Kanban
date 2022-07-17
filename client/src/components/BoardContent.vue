<template>
  <div class="flex flex-col flex-1 max-h-full max-w-full w-full h-full">
    <Navbar />

    <div class="h-full w-full overflox-x-scroll px-6 py-2 bg-slate-100">
      <!-- <div v-if="currentBoard" class="p-4 h-full w-full">
        <p>{{ currentBoard.name }}</p>
        <p>{{ currentBoard.description }}</p>
      </div> -->
      <!-- <Block /> -->
      <ul v-if="currentBoard && currentBoard.tasks" class="flex gap-10">
        <li
          v-for="task in currentBoard.tasks"
          :key="task.id"
          class="rounded-lg px-4 py-2 border shadow-lg bg-white"
        >
          {{ task.name }}
        </li>
      </ul>

      <div v-else>loading.....</div>
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
