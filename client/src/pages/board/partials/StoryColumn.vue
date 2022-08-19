<template>
  <div class="inline-block">
    <div class="w-56 min-w-56 h-full flex flex-col group p-2">
      <div class="flex items-center gap-4 mb-4 w-full">
        <span class="rounded-full bg-green-800 w-4 h-4" />

        <div class="flex justify-between text-sm w-full">
          <p class="font-semibold">{{ story.name }}</p>

          <p>{{ `( ${tasks.length} )` }}</p>
        </div>
      </div>

      <!-- tasks -->
      <div v-show="loaded">
        <div
          ref="tasks"
          class="flex flex-col gap-4 overflow-y-auto h-96 scrollbar"
        >
          <div
            v-for="task in tasks"
            :key="task.name"
            class="rounded-md shadow-xl h-24 w-full bg-slate-100 p-4 flex flex-col justify-between"
          >
            <!-- content -->
            <p>
              {{ task.name }}
            </p>

            <p class="text-sm">
              {{ "Subtasks ( x / y )" }}
            </p>
          </div>
        </div>

        <TextButton
          v-show="!showAddTask"
          ref="addbtn"
          class="w-full mx-0 bg-white top-10 shadow-md invisible group-hover:visible"
          @click="showAddTask = true"
        >
          Add
        </TextButton>

        <div
          v-show="showAddTask"
          class="rounded-md shadow-xl h-24 w-full bg-slate-100 my-2 p-4 flex flex-col justify-between"
        >
          <input
            ref="input"
            v-model="form.task.name"
            class="h-6 rounded-md"
            @keydown.enter="addTask(form.task)"
          />

          <div class="flex w-full justify-between">
            <AbstractButton class="text-sm px-4 py-1" @click="reset">
              Cancel
            </AbstractButton>
            <AbstractButton
              class="text-sm px-4 py-1"
              :class="isFormEmpty && 'pointer-events-none opacity-50'"
              @click="addTask(form.task)"
            >
              Add
            </AbstractButton>
          </div>
        </div>
      </div>

      <div v-show="!loaded" class="animate-pulse flex flex-col gap-4">
        <div
          v-for="i in 5"
          :key="i"
          class="rounded-md shadow-xl h-24 w-full bg-slate-100 p-4 flex flex-col justify-around"
        >
          <span class="h-2 w-full rounded-full bg-slate-400" />
          <span class="h-2 w-1/2 rounded-full bg-slate-400" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { animate, stagger } from "motion"

export default {
  props: {
    story: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    showAddTask: false,
    tasks: [],
    loaded: false,
    form: {
      task: {
        name: "",
        completed: false,
      },
    },
  }),

  computed: {
    isFormEmpty() {
      return this.form.task.name === ""
    },
  },

  mounted() {
    this.staggerAnimation(this.$refs.tasks)
  },

  created() {
    this.fetchTasks()
  },

  methods: {
    addTask(task) {
      if (this.isFormEmpty) {
        return
      }

      this.$http
        .post("/tasks", task, {
          params: { storyId: this.story.id },
        })
        .then(({ data }) => {
          this.reset()
          this.tasks = [...this.tasks, data]
        })
    },

    fetchTasks() {
      this.$http
        .get("/tasks", {
          params: { storyId: this.story.id },
        })
        .then(({ data }) => {
          this.loaded = true
          this.tasks = data
        })
    },
    reset() {
      this.showAddTask = false
      this.form.task = {
        name: "",
        completed: false,
      }
    },
    staggerAnimation(list) {
      // console.log(list)
      // console.log(list.children)

      animate(
        list.children,
        { opacity: [0, 1] },
        { delay: stagger(0.1, { start: 0.2 }) }
      )
    },
  },
}
</script>
