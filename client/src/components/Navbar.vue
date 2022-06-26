<template>
  <div class="navbar bg-base-100 border-b-2">
    <a class="btn btn-ghost normal-case text-xl">KANBAN</a>
    <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden"
      >Open drawer</label
    >
    <input
      type="checkbox"
      class="toggle"
      :checked="themeStore.darkMode"
      @change="themeStore.toggleTheme"
    />
  </div>
</template>

<script>
import { useThemeStore } from "../stores/theme"

export default {
  data: () => ({
    themeStore: useThemeStore(),
  }),
}
</script>
