<template>
  <div class="w-screen h-screen">
    <TextButton>
      <router-link to="/signup">
        {{ "Sign up" }}
      </router-link>
    </TextButton>

    <TextButton>
      <router-link to="/signin">
        {{ "Sign in" }}
      </router-link>
    </TextButton>
  </div>
</template>

<script>
export default {}
</script>
