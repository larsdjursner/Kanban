<template>
  <router-link
    class="bg-slate-100 hover:bg-slate-300 rounded-lg my-2 mr-2"
    :class="isCurrentBoard && 'bg-slate-200'"
    :to="{ name: 'board', params: { id: board.id } }"
  >
    <div class="flex flex-col min-h-14 h-14 w-full p-2">
      <p class="font-semibold">{{ board.title }}</p>
    </div>
  </router-link>
</template>

<script>
export default {
  props: {
    isCurrentBoard: {
      type: Boolean,
      default: false,
    },

    board: {
      type: Object,
      required: true,
    },
  },
}
</script>
