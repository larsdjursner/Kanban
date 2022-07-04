<template>
  <router-link :to="{ name: 'board', params: { id: board.id } }">
    <div
      ref="btn"
      class="px-6 py-4 w-full"
      :class="isCurrentlySelected && 'bg-indigo-600 rounded-r-full'"
      @click="click"
    >
      <p
        class="font-semibold w-full"
        :class="isCurrentlySelected ? 'text-white' : 'text-slate-300'"
      >
        {{ board.name }}
      </p>
    </div>
  </router-link>
</template>

<script>
import { useStore } from "../stores/store"
import { animate } from "motion"

export default {
  props: {
    board: {
      type: Object,
      required: true,
    },
  },

  data: () => ({
    store: useStore(),
  }),

  computed: {
    isCurrentlySelected() {
      return this.store.getCurrentBoard.id === this.board.id
    },
  },
  methods: {
    click() {
      animate(this.$refs.btn, { scale: [1, 1.1, 1] })
    },
  },
}
</script>
