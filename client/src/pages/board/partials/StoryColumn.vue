<template>
  <div
    class="w-56 min-w-56 h-full flex flex-col group border border-black rounded-lg p-2"
  >
    <div class="flex items-center gap-4 mb-4 w-full">
      <span class="rounded-full bg-green-800 w-4 h-4" />

      <div class="flex justify-between text-sm w-full">
        <p class="font-semibold">{{ story.name }}</p>

        <p>{{ `( ${story.tasks ? story.tasks.length : 0} )` }}</p>
      </div>
    </div>

    <!-- tasks -->
    <div
      v-for="task in story.tasks"
      :key="task.name"
      class="rounded-md shadow-xl h-24 w-full bg-slate-100 my-2 p-4 flex flex-col justify-between"
    >
      <!-- content -->
      <p>
        {{ task.name }}
      </p>

      <p class="text-sm">
        {{ "Subtasks ( 0 / 3 )" }}
      </p>
    </div>

    <TextButton
      ref="addbtn"
      class="w-full mx-0 bg-white top-10 shadow-md invisible group-hover:visible"
      @click="addTask"
    >
      Add
    </TextButton>
  </div>
</template>

<script>
export default {
  props: {
    story: {
      type: Object,
      required: true,
    },
  },

  methods: {
    addTask() {
      console.log("addTask")
    },
  },
}
</script>
