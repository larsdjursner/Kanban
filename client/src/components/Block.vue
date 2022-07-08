<template>
  <div class="bg-slate-100 rounded-lg h-96 w-64">
    <!-- title -->
    <p class="font-bold flex justify-center text-xl border-b-2">{{ title }}</p>
    <!-- stories -->
    <div class="overflow-y-scroll">
      <!-- <Story v-for="story in stories" :key="story.id" :story="story" /> -->
    </div>
  </div>
</template>

<script>
import Story from "./Story.vue"
export default {
  components: { Story },

  props: {
    title: {
      type: String,
      default: "Todo",
    },
  },

  data: () => ({}),
}
</script>
