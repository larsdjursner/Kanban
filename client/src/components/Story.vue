<template>
  <div class="rounded-lg m-2 bg-slate-200 h-20">
    <p>{{ story.title }}</p>
  </div>
</template>

<script>
export default {
  props: {
    story: {
      type: Object,
    },
  },

  data: () => ({}),
}
</script>
