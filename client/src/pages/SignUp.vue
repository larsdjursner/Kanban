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
        <TextButton>Cancel</TextButton>
        <TextButton>
          <router-link to="/signin">
            {{ "Sign in" }}
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
    form: {
      name: "",
      email: "",
      password: "",
      cpassword: "",
    },
    submitting: false,
    auth: useAuth(),
  }),

  methods: {
    async submit() {
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
