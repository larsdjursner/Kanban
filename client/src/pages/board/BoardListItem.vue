<template>
  <router-link :to="{ name: 'board', params: { id: board.id } }">
    <div
      ref="btn"
      class="px-6 py-4 w-full"
      :class="isCurrentlySelected && 'bg-indigo-600 rounded-r-full'"
      @click="click"
    >
      <div ref="content" class="w-full flex items-center gap-2">
        <TemplateIcon
          class="h-4 w-4"
          :class="isCurrentlySelected ? 'text-white' : 'text-slate-500'"
        />
        <p
          class="font-semibold w-full"
          :class="isCurrentlySelected ? 'text-white' : 'text-slate-800'"
        >
          {{ board.name }}
        </p>
      </div>
    </div>
  </router-link>
</template>

<script>
import { useStore } from "../../stores/store"
import { animate } from "motion"
import { TemplateIcon } from "@heroicons/vue/outline"

export default {
  components: { TemplateIcon },

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
      return parseInt(this.$route.params.id) === this.board.id
    },
  },
  methods: {
    click() {
      animate(this.$refs.btn, { opacity: [0, 1] })
    },
  },
}
</script>
