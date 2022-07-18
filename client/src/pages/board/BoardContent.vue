<template>
  <div class="h-full w-full overflox-x-scroll px-6 py-2 bg-slate-100">
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
</template>

<script>
import { useStore } from "../../stores/store"

export default {
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
}
</script>
