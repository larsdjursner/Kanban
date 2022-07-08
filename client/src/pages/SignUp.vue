<template>
  <div class="w-screen h-screen flex justify-center items-center">
    <div class="flex flex-col gap-6 w-[40rem] p-4 shadow-lg rounded-lg">
      <p class="text-2xl font-semibold">Sign Up</p>

      <span class="w-full border-t" />

      <FormInput
        v-model="form.name"
        text="Name"
        placeholder="Enter your name..."
      />

      <FormInput
        v-model="form.email"
        text="Email"
        placeholder="Enter an email..."
      />

      <FormInput
        v-model="form.password"
        text="Password"
        placeholder="Enter password..."
        password
      />

      <FormInput
        v-model="form.repeatPassword"
        text="Password"
        placeholder="Repeat password..."
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
        to="/signin"
        class="hover:underline text-blue-500 hover:text-blue-400 self-center"
      >
        {{ "Already have an account? Sign in instead" }}
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
    form: {
      name: "",
      email: "",
      password: "",
      repeatPassword: "",
    },
    submitting: false,
    auth: useAuth(),
  }),

  methods: {
    async submit() {
      if (this.form.password !== this.form.repeatPassword) {
        prompt("Passwords are not equal!")
        return
      }
      this.submitting = true
      await this.$http
        .post("/signup", this.form)
        .then(({ data }) => this.auth.setAuth(data))
        .catch((err) => {
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
          console.log(err)
          return
        })
    },
  },
}
</script>
