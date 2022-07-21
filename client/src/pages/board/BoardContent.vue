<template>
  <div class="h-full w-full overflox-x-scroll px-6 py-2 bg-slate-200">
    <!-- <div v-if="currentBoard && currentBoard.stories" class="">
      <ul class="flex gap-10">
        <li
          v-for="story in currentBoard.stories"
          :key="story.id"
          class="rounded-lg px-4 py-2 border shadow-lg bg-white"
        >
          {{ story.name }}
        </li>
      </ul>
    </div>

    <div v-else>loading.....</div> -->

    <div
      v-for="story in mockstories"
      :ref="story.name"
      :key="story.name"
      class="w-40 h-full flex flex-col"
    >
      <div class="flex items-center gap-4">
        <span class="rounded-full bg-green-800 w-4 h-4" />

        <div class="flex gap-2">
          <p class="font-semibold">{{ story.name }}</p>

          <p>{{ `( ${story.tasks.length} )` }}</p>
        </div>
      </div>

      <div
        v-for="task in story.tasks"
        :key="task.name"
        class="rounded-md shadow-xl h-20 w-full bg-slate-100 my-1"
      >
        {{ task.name }}
      </div>
    </div>
  </div>
</template>

<script>
import { useStore } from "../../stores/store"
import { animate, stagger } from "motion"

export default {
  props: {
    id: { type: Number, required: true },
  },

  data: () => ({
    store: useStore(),

    mockstories: [
      {
        name: "TODO",
        tasks: [
          { name: "do something", completed: false },
          { name: "do something1", completed: false },
          { name: "do something2", completed: false },
          { name: "do something3", completed: false },
          { name: "do something4", completed: false },
        ],
      },
    ],
  }),

  computed: {
    currentBoard() {
      return this.store.currentBoard
    },
  },

  async mounted() {
    this.appendAnimations()
  },

  methods: {
    appendAnimations() {
      const list = this.$refs.TODO[0]
      console.log(list, list.children)

      animate(
        list.children,
        { opacity: [0, 1] },
        { delay: stagger(0.1, { start: 0.3 }) }
      )
    },
  },
}
</script>
