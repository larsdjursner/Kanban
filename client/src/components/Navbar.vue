<template>
  <div
    class="w-screen max-w-screen h-14 min-h-14 max-h-14 border-b py-2 px-4 flex items-center justify-between"
  >
    <div class="w-1/4">
      <p class="text-xl font-semibold">Kanban</p>
    </div>

    <div class="w-1/2 flex">
      <!-- <div class="flex gap-20 w-1/3">
        <div v-if="currentBoard" class="flex items-center text-slate-600 gap-2">
          <p class="text-xl font-semibold">{{ `${currentBoard.name}` }}</p>
          <button @click="$emit('showModal')">
            <CogIcon class="h-5 w-5" />
          </button>
        </div>
      </div> -->

      <div class="w-2/3">
        <p class="text-xl font-semibold">
          {{ `${auth.user.name}'s Workspace` }}
        </p>
      </div>
    </div>

    <div class="w-1/4">
      <div class="flex items-center gap-6 justify-end">
        <Dropdown>
          <template #button>
            <button
              class="bg-slate-200 focus:bg-slate-300 p-2 rounded-full flex justify-center items-center"
            >
              <UserIcon class="w-4 h-4" />
            </button>
          </template>

          <template #menu>
            <button
              v-for="item in menu"
              :key="item.name"
              :ref="item.ref"
              class="w-40 flex justify-between items-center py-2 px-4 hover:bg-slate-100"
              @click="handleClick(item)"
            >
              <p>{{ item.text }}</p>
              <component :is="item.icon" class="w-4 h-4" />
            </button>
          </template>
        </Dropdown>
      </div>
    </div>
  </div>
</template>

<script>
import { animate } from "motion"
import { useStore } from "../stores/store"
import { useAuth } from "../stores/auth"
import TextButton from "./buttons/TextButton.vue"
import Toggle from "./buttons/ThemeToggle.vue"
import {
  LogoutIcon,
  UserIcon,
  CogIcon,
  ColorSwatchIcon,
} from "@heroicons/vue/outline"
import Dropdown from "./menu/Dropdown.vue"

export default {
  components: {
    TextButton,
    Toggle,
    UserIcon,
    Dropdown,
    CogIcon,
  },

  emits: ["showModal"],

  data: () => ({
    store: useStore(),
    auth: useAuth(),
    showModal: false,

    menu: [],
  }),

  computed: {
    id() {
      return this.$route.params.id
    },

    currentBoard() {
      return this.store.getCurrentBoard
    },
  },

  created() {
    this.menu = [
      {
        text: "Profile",
        ref: "profile",
        action: () => {
          this.$router.push("/user")
        },
        icon: ColorSwatchIcon,
      },

      {
        text: "Settings",
        ref: "settings",
        action: () => {
          this.$router.push("/user/settings")
        },
        icon: CogIcon,
      },

      {
        text: "Log out",
        ref: "logout",
        action: () => {
          this.auth.logout()
          this.$router.push("/")
        },
        icon: LogoutIcon,
      },
    ]
  },

  methods: {
    handleClick(item) {
      animate(this.$refs[item.ref], { scale: [1, 1.1, 1] })

      item.action()
    },
  },
}
</script>
