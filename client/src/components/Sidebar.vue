<template>
  <div class="drawer drawer-mobile">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
      <slot />
    </div>
    <div class="drawer-side flex h-screen">
      <label for="my-drawer-2" class="drawer-overlay"></label>
      <div
        class="menu p-4 overflow-y-auto w-80 text-base-content bg-slate-200 border-r-2 border-slate-300 flex"
      >
        <!-- Sidebar content here -->
        <div class="flex flex-col h-full w-full">
          <p class="mb-10 font-bold text-2xl self-center">KANBAN</p>
          <ul
            class="overflow-y-scroll scrollbar border-t-2 border-slate-300 pt-2"
          >
            <li v-for="board in store.getBoards" :key="board.id" class="my-2">
              <router-link :to="{ name: 'board', params: { id: board.id } }">
                {{ board.title }}
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="h-screen w-5 bg-slate-600 hover:bg-slate-400"></div>
  </div>
</template>

<script>
import { useStore } from "../stores/store"

export default {
  data: () => ({
    store: useStore(),
  }),

  created() {
    this.store.fetchBoards()
    this.store.setCurrentBoard(this.$route.params.id)

    this.$watch(
      () => this.$route.params,
      ({ id }) => {
        this.store.setCurrentBoard(id)
      }
    )
  },
}
</script>
