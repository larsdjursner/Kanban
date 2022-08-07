<template>
  <div class="h-full w-full px-6 py-2 bg-slate-200 flex gap-4">
    <div ref="stories" class="flex gap-4 w-3/4 max-w-3/4 overflow-x-scroll">
      <StoryColumn v-for="story in stories" :key="story.id" :story="story" />
    </div>
    <AddStory @addStory="addStory($event)" />
  </div>

  <!-- </div> -->
</template>

<script>
import { useStore } from "../../stores/store"
import { animate, stagger } from "motion"
import AddStory from "./partials/AddStory.vue"
import StoryColumn from "./partials/StoryColumn.vue"

export default {
  components: { AddStory, StoryColumn },

  props: {
    id: { type: Number, required: true },
  },

  data: () => ({
    store: useStore(),
    stories: [],
  }),

  computed: {
    currentBoard() {
      return this.store.currentBoard
    },
  },

  watch: {
    currentBoard(board) {
      this.fetchStories(board.id)
    },
  },

  created() {
    // computed props not calculated yet
    const boardId = this.$route.params.id

    this.fetchStories(boardId)
  },

  mounted() {
    // Append animations for stories
    if (this.stories.length > 0) {
      const lists = Object.values(this.$refs.stories)
      lists.map((list) => this.staggerAnimation(list))
    }
  },

  methods: {
    addStory(story) {
      this.$http
        .post("/stories", story, {
          params: { boardId: this.currentBoard.id },
        })
        .then((res) => {
          this.stories = [...this.stories, res.data]
        })
    },

    fetchStories(boardId) {
      this.$http.get("/stories", { params: { boardId } }).then((res) => {
        this.stories = res.data
        console.log(this.stories)
      })
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
  },
}
</script>
