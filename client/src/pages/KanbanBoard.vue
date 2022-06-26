<template>
  <Sidebar>
    <div class="h-full w-full">
      <Navbar />
      <div class="m-10 flex gap-8">
        <Block />
        <Block />
        <Block />
      </div>
    </div>
  </Sidebar>
</template>

<script>
import Navbar from "../components/Navbar.vue"
import Sidebar from "../components/Sidebar.vue"
import Block from "../components/Block.vue"
export default { components: { Navbar, Sidebar, Block } }
</script>
