<template>
  <div class="w-screen h-screen flex justify-center items-center">
    <div class="flex flex-col gap-6 w-[40rem] p-4 shadow-lg rounded-lg">
      <p class="text-2xl font-semibold">Sign In</p>

      <span class="w-full border-t" />

      <FormInput
        v-model="form.email"
        text="Email"
        placeholder="Enter email..."
        required
      />

      <FormInput
        v-model="form.password"
        text="Password"
        placeholder="Enter password..."
        required
        password
      />

      <TextButton
        class="grid grid-cols-3 w-full mx-0 shadow-lg"
        @click="submit"
      >
        <span />
        <p class="text-xl">Submit</p>
        <Throbber v-if="submitting" />
      </TextButton>

      <router-link
        to="/signup"
        class="hover:underline text-blue-500 hover:text-blue-400 self-center"
      >
        {{ "Don't have an account? Sign up instead" }}
      </router-link>
    </div>
  </div>
</template>

<script>
import { useAuth } from "../stores/auth"
import FormInput from "../components/form/FormInput.vue"
export default {
  components: { FormInput },

  data: () => ({
    auth: useAuth(),
    form: {
      email: "",
      password: "",
    },
    submitting: false,
  }),

  methods: {
    async submit() {
      this.submitting = true
      await this.$http
        .post("/signin", this.form)
        .then(({ data }) => this.auth.setAuth(data))
        .catch((err) => {
          this.submitting = false

          console.log(err)
          return
        })

      const token = JSON.parse(sessionStorage.getItem("token"))
      this.$http.defaults.headers.common[
        "Authorization"
      ] = `${token.token_type} ${token.access_token}`

      await this.$http
        .get("/getuser")
        .then(({ data }) => {
          this.auth.setUser(data)
          this.$router.push("/boards")
        })
        .catch((err) => {
          this.submitting = false

          console.log(err)
          return
        })
    },
  },
}
</script>
