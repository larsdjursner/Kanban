<template>
  <div class="drawer drawer-mobile">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
      <slot />
    </div>
    <div class="drawer-side">
      <label for="my-drawer-2" class="drawer-overlay"></label>
      <div
        class="menu p-4 overflow-y-auto w-80 text-base-content bg-slate-200 border-r-2 border-slate-300"
      >
        <!-- Sidebar content here -->
        <div class="">
          <p class="mb-10 font-bold text-2xl">KANBAN</p>
        </div>
        <ul class="overflow-y-scroll">
          <li v-for="board in store.getBoards" :key="board.id" class="my-2">
            {{ board.title }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { useStore } from "../stores/store"

export default {
  data: () => ({
    store: useStore(),
  }),
}
</script>
