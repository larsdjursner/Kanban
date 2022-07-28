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

    <div ref="addStory" class="h-96 flex flex-col">
      <div
        ref="input"
        class="flex"
        :class="showAddStory ? 'visible' : 'invisible'"
      >
        <input
          v-model="form.story"
          class="w-full rounded-md h-10 px-2 mr-2"
          placeholder="story name"
        />

        <TextButton v-if="changed" ref="addbtn" class="w-16" @click="add(form)"
          >Add</TextButton
        >

        <button ref="cancelbtn" @click="toggleAddStory(false)">
          <XIcon class="h-4 w-4" />
        </button>
      </div>

      <button
        class="rounded-md w-40 bg-slate-300 opacity-60 hover:opacity-40 h-full flex justify-center items-center"
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
import TextButton from "../../components/buttons/TextButton.vue"
import FormInput from "../../components/form/FormInput.vue"
import { XIcon } from "@heroicons/vue/outline"

export default {
  components: { TextButton, FormInput, XIcon },

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

    form: {
      story: "",
    },
    changed: false,
  }),

  computed: {
    currentBoard() {
      return this.store.currentBoard
    },
  },

  watch: {
    form: {
      handler() {
        if (!this.changed) {
          this.changed = true

          //animate btns
          animate(this.$refs.cancelbtn, { x: [null, 0] })
          animate(this.$refs.addbtn, { y: [null, 0] })
        }
      },
      deep: true,
    },
  },

  mounted() {
    // Append animations for stories
    const lists = Object.values(this.$refs.stories)
    lists.map((list) => this.staggerAnimation(list))

    // Append animation to add story pane
    this.slideLeft(this.$refs.addStory)
  },

  methods: {
    reset() {
      this.form = {
        story: "",
      }

      this.changed = false
    },

    async add(story) {
      console.log(story)
    },

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

    slideLeft(element) {
      animate(
        element,
        { x: [200, 0], opacity: [0, 1] },
        { duration: 0.8, delay: 0.3 }
      )
    },

    slideDown(element) {
      animate(element, { y: [-20, 0] }, { duration: 0.3 })
    },

    slideUp(element) {
      animate(element, { y: [100, 0] }, { duration: 0.3 })
    },

    toggleAddStory(bool) {
      this.showAddStory = bool

      if (!this.showAddStory && this.changed) {
        // some sort of confirm
        this.reset()
      }

      this.showAddStory
        ? this.slideUp(this.$refs.addStory)
        : this.slideDown(this.$refs.addStory)
    },
  },
}
</script>
