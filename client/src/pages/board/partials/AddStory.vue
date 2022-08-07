<template>
  <div ref="addStory" class="h-96 flex flex-col">
    <div
      ref="input"
      class="flex relative"
      :class="showAddStory ? 'visible' : 'invisible'"
    >
      <input
        v-model="form.story.name"
        class="w-full rounded-md h-10 px-2 mr-2"
        placeholder="Enter a story name ..."
      />

      <button ref="cancelbtn" @click="toggleAddStory(false)">
        <XIcon class="h-4 w-4" />
      </button>

      <TextButton
        v-if="changed"
        ref="addbtn"
        class="w-full mx-0 bg-white top-10 shadow-md absolute"
        @click="add(form.story)"
      >
        Add
      </TextButton>
    </div>

    <button
      class="rounded-md w-40 bg-slate-300 opacity-60 hover:opacity-40 h-full flex justify-center items-center"
      :class="showAddStory ? 'invisible' : 'visible'"
      @click="toggleAddStory(true)"
    >
      <p class="font-semibold text-lg text-slate-600">+ New story</p>
    </button>
  </div>
</template>

<script>
import { animate } from "motion"
import { XIcon } from "@heroicons/vue/outline"

export default {
  components: { XIcon },

  emits: ["addStory"],

  data: () => ({
    changed: false,
    showAddStory: false,

    form: {
      story: {
        name: "",
      },
    },
  }),

  watch: {
    form: {
      handler() {
        if (!this.changed) {
          this.changed = true
        }
      },
      deep: true,
    },
  },

  mounted() {
    const { addStory } = this.$refs

    this.slideLeft(addStory)
  },

  methods: {
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

    reset() {
      this.form = {
        story: {
          name: "",
        },
      }

      this.changed = false
    },

    add(story) {
      this.$emit("addStory", story)

      this.reset()
    },

    slideLeft(element) {
      animate(
        element,
        { x: [200, 0], opacity: [0, 1] },
        { duration: 0.8, delay: 0.3 }
      )
    },

    slideDown(element) {
      animate(element, { y: [-20, 0] }, { duration: 0.3, delay: 0.1 })
    },

    slideUp(element) {
      animate(element, { y: [100, 0] }, { duration: 0.3, delay: 0.1 })
    },
  },
}
</script>
