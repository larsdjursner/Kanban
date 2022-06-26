<template>
  <div class="bg-slate-100 rounded-lg h-full">
    <!-- title -->
    <p class="font-bold flex justify-center text-xl border-b-2">{{ title }}</p>
    <!-- stories -->
    <Story v-for="story in stories" :key="story.id" :story="story" />
  </div>
</template>

<script>
import storiesData from "../mockdata/stories.json"
import Story from "./Story.vue"
export default {
  components: { Story },
  props: {
    title: {
      type: String,
      default: "Todo",
    },
  },

  data: () => ({
    stories: storiesData,
  }),
}
</script>
