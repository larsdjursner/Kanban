<template>
  <div class="w-screen h-screen flex justify-center items-center">
    <div class="flex flex-col gap-8 h-80 w-96">
      <p class="text-2xl">Sign In</p>
      <div class="flex justify-between">
        <p>email</p>
        <input v-model="form.email" />
      </div>

      <div class="flex justify-between">
        <p>password</p>
        <div class="">
          <input
            v-model="form.password"
            :type="showPassword ? 'text' : 'password'"
          />
          <input v-model="showPassword" type="checkbox" />
        </div>
      </div>

      <div class="flex justify-between">
        <TextButton>Cancel</TextButton>
        <TextButton>
          <router-link to="/signup">
            {{ "Sign up" }}
          </router-link>
        </TextButton>
        <TextButton @click="submit" class="flex gap-2 items-baseline">
          <p>Submit</p>
          <Throbber v-if="submitting" />
        </TextButton>
      </div>
    </div>
  </div>
</template>

<script>
import { useAuth } from "../stores/auth"

export default {
  data: () => ({
    auth: useAuth(),
    form: {
      email: "",
      password: "",
    },
    showPassword: false,
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
