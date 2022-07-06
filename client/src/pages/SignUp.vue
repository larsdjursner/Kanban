<template>
  <div class="w-screen h-screen flex justify-center items-center">
    <div class="flex flex-col">
      <p class="text-2xl">Sign Up</p>

      <div class="flex">
        <p>name</p>
        <input v-model="form.name" />
      </div>

      <div class="flex">
        <p>email</p>
        <input v-model="form.email" />
      </div>

      <div class="flex">
        <p>password</p>
        <input v-model="form.password" />
      </div>

      <div class="flex">
        <p>repeat password</p>
        <input v-model="form.cpassword" />
      </div>

      <div class="flex">
        <AbstractButton>Cancel</AbstractButton>
        <AbstractButton>
          <router-link to="/signin">
            {{ "Sign in" }}
          </router-link>
        </AbstractButton>
        <AbstractButton @click="submit">Submit</AbstractButton>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    form: {
      name: "",
      email: "",
      password: "",
      cpassword: "",
    },
  }),

  methods: {
    submit() {
      console.log(this.form)
    },
  },
}
</script>
