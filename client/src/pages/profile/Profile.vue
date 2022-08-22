<template>
  <div class="h-screen w-screen max-w-screen max-h-screen flex flex-col">
    <Navbar />

    <div class="flex h-full w-full">
      <div class="w-1/5 h-full border-r px-4 py-8">
        <button
          class="text-lg font-semibold flex justify-start items-center gap-4 hover:bg-slate-200 w-full px-auto rounded-md py-1"
          @click="back"
        >
          <ChevronLeftIcon class="h-4 w-4" />
          Back
        </button>

        <div class="flex">
          <p>My account</p>
        </div>
        <div class="mx-4">
          <div class="">
            <router-link :to="{ name: 'usercustomize' }">
              <p>Customize profile</p>
            </router-link>
          </div>

          <div class="">
            <router-link :to="{ name: 'userpassword' }">
              <p>Password</p>
            </router-link>
          </div>

          <div class="">
            <router-link :to="{ name: 'usersecurity' }">
              <p>Security</p>
            </router-link>
          </div>
        </div>
      </div>

      <div class="w-full h-full p-2 flex gap-4">
        <router-view></router-view>

        <div class="h-full flex justify-center items-center">
          <div class="w-full h-1/2 bg-indigo-400 rounded-lg"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "@/components/Navbar.vue"
import { ChevronLeftIcon, UserCircleIcon } from "@heroicons/vue/outline"

export default {
  components: { Navbar, ChevronLeftIcon, UserCircleIcon },

  data: () => ({
    navigationCount: 0,
  }),

  updated() {
    this.navigationCount += 1
  },

  methods: {
    back() {
      this.$router.go(-(this.navigationCount + 1))
    },
  },
}
</script>
