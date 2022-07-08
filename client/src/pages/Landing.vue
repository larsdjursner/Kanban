<template>
  <div class="w-screen h-screen">
    <AbstractButton>
      <router-link to="/signup">
        {{ "Sign up" }}
      </router-link>
    </AbstractButton>

    <AbstractButton>
      <router-link to="/signin">
        {{ "Sign in" }}
      </router-link>
    </AbstractButton>
  </div>
</template>

<script>
import AbstractButton from "../components/buttons/AbstractButton.vue"
export default { components: { AbstractButton } }
</script>
