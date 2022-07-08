<template>
  <div class="flex flex-col flex-1 max-h-full max-w-full w-full h-full">
    <Navbar />

    <div class="h-full w-full overflox-x-scroll">
      <div class="p-4 h-full w-full">
        <p>{{ board.name }}</p>
        <p>{{ board.description }}</p>
      </div>
      <!-- <Block /> -->
    </div>
  </div>
</template>

<script>
import Navbar from "./Navbar.vue"

export default {
  components: { Navbar },

  props: {
    id: { type: Number, required: true },
  },

  data: () => ({
    board: {},
  }),

  async created() {
    await this.fetchBoard()

    this.$watch(
      () => this.id,
      () => {
        this.fetchBoard()
      }
    )
  },

  methods: {
    async fetchBoard() {
      await this.$http
        .get(`/boards/${this.id}`)
        .then(({ data }) => (this.board = data))
    },
  },
}
</script>
