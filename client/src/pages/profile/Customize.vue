<template>
  <div class="flex flex-col h-full w-full">
    <FormInput
      v-model="user.name"
      text="name"
      placeholder="Enter your name"
      required
    />

    <FormInput
      v-model="user.email"
      text="email"
      placeholder="Enter your email"
      required
    />
  </div>
</template>

<script>
import { useAuth } from "@/stores/auth"
export default {
  data: () => ({
    auth: useAuth(),
    user: null,
  }),

  created() {
    this.user = this.auth.user
  },
}
</script>

<style></style>
