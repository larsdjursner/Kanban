<template>
  <div
    class="h-full w-full overflow-x-auto scrollbar flex shadow-inner rounded-md"
  >
    <StoryColumn v-for="story in stories" :key="story.id" :story="story" />
    <AddStory @addStory="addStory($event)" />
  </div>
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
    this.fetchStories(this.id)
  },

  mounted() {
    // Append animations for stories
    // if (this.stories.length > 0) {
    //   const lists = Object.values(this.$refs.stories)
    //   lists.map((list) => this.staggerAnimation(list))
    // }
  },

  methods: {
    addStory(story) {
      this.$http
        .post("/stories", story, {
          params: { boardId: this.currentBoard.id },
        })
        .then(({ data }) => {
          this.stories = [...this.stories, data]
        })
    },

    fetchStories(boardId) {
      this.$http.get("/stories", { params: { boardId } }).then(({ data }) => {
        this.stories = data
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
