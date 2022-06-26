<template>
  <h1 class="text-3xl font-bold underline">Hello world!</h1>
  <p>{{ store.getCount }}</p>
  <p>{{ store.getCountTimesTwo }}</p>
  <button @click="store.increment">increment</button>
  <button @click="store.randomizeCounter">randomize</button>
</template>

<script>
import { useStore } from "./stores/store"

export default {
  data: () => ({
    store: useStore(),
  }),
}
</script>
