<template>
  <div
    class="h-full w-full overflox-x-scroll px-6 py-2 bg-slate-200 flex gap-4"
  >
    <div
      v-for="story in mockstories"
      ref="stories"
      :key="story.name"
      class="w-40 h-full flex flex-col"
    >
      <div class="flex items-center gap-4 mb-4">
        <span class="rounded-full bg-green-800 w-4 h-4" />

        <div class="flex gap-2 text-sm">
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

    <div ref="addStory" class="h-96 w-40">
      <div
        ref="input"
        class="flex gap-4 mb-4"
        :class="showAddStory ? 'visible' : 'invisible'"
      >
        <input class="w-full rounded-md" placeholder="" />

        <button @click="toggleAddStory(false)">x</button>
      </div>

      <button
        class="rounded-md bg-slate-300 opacity-60 hover:opacity-40 h-full w-full flex justify-center items-center"
        :class="showAddStory ? 'invisible' : 'visible'"
        @click="toggleAddStory(true)"
      >
        <p class="font-semibold text-lg text-slate-600">+ New story block</p>
      </button>
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

    showAddStory: false,

    stories: [],
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
      {
        name: "Doing",
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

  mounted() {
    // Append animations for stories
    const lists = Object.values(this.$refs.stories)
    lists.map((list) => this.staggerAnimation(list))

    // Append animation to add story pane
    this.slideDown(this.$refs.addStory)
  },

  methods: {
    staggerAnimation(list) {
      if (!list.children) {
        return
      }

      animate(
        list.children,
        { opacity: [0, 1] },
        { delay: stagger(0.1, { start: 0.3 }) }
      )
    },

    slideDown(element) {
      animate(element, { x: [200, 0] }, { duration: 0.8, delay: 0.3 })
    },

    toggleAddStory(bool) {
      this.showAddStory = bool
    },
  },
}
</script>
