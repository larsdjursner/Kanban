<template>
  <div class="w-full max h-14 border-b-2 p-2 flex items-baseline">
    <p clpss="text-xl">
      {{ store.currentBoard.title }}
    </p>
    <!-- <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden"
      >Open drawer</label
    > -->
    <input
      type="checkbox"
      class="toggle"
      :checked="themeStore.darkMode"
      @change="themeStore.toggleTheme"
    />
  </div>
</template>

<script>
import { useStore } from "../stores/store"
import { useThemeStore } from "../stores/theme"

export default {
  data: () => ({
    themeStore: useThemeStore(),
    store: useStore(),
  }),
}
</script>
