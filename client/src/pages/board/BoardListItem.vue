<template>
  <router-link :to="{ name: 'board', params: { id: board.id } }">
    <div class="relative w-full h-full my-2 pr-6" @click="click">
      <div
        ref="btn"
        class="px-6 py-4 h-full w-full"
        :class="isCurrentlySelected && 'bg-indigo-600 rounded-r-full'"
      />

      <div
        ref="content"
        class="absolute inset-0 left-4 w-full flex items-center gap-2"
      >
        <TemplateIcon
          class="h-4 w-4"
          :class="isCurrentlySelected ? 'text-white' : 'text-slate-500'"
        />
        <p
          class="font-semibold w-full"
          :class="
            isCurrentlySelected
              ? 'text-white'
              : 'text-slate-800 hover:text-indigo-600'
          "
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

  mounted() {
    this.isCurrentlySelected && this.click()
  },

  methods: {
    click() {
      animate(
        this.$refs.btn,
        { x: [-120, 0], easing: "ease" },
        { duration: 0.6, delay: 0.1 }
      )
    },
  },
}
</script>
