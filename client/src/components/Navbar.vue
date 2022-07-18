<template>
  <!-- <BoardModal
    v-if="showModal"
    :showModal="showModal"
    editing
    @closeModal="showModal = false"
  /> -->
  <div
    class="w-full max h-14 border-b-2 py-2 px-4 flex items-center justify-between"
  >
    <div>
      <div v-if="currentBoard" class="flex items-center text-slate-600 gap-2">
        <p class="text-xl font-semibold">{{ `${currentBoard.name}` }}</p>
        <button @click="$emit('showModal')">
          <CogIcon class="h-5 w-5" />
        </button>
      </div>
    </div>
    <p class="text-xl font-semibold">{{ `${auth.user.name}'s Workspace` }}</p>
    <div class="flex items-center gap-6">
      <TextButton>Add task</TextButton>
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

    menu: [
      {
        text: "Profile",
        ref: "profile",
        action: () => {
          this.toUser
        },
        icon: ColorSwatchIcon,
      },

      {
        text: "Settings",
        ref: "settings",
        action: () => {
          this.toSettings
        },
        icon: CogIcon,
      },

      {
        text: "Log out",
        ref: "logout",
        action: () => {
          this.logout
        },
        icon: LogoutIcon,
      },
    ],
  }),

  computed: {
    id() {
      return this.$route.params.id
    },

    currentBoard() {
      return this.store.currentBoard
    },
  },

  methods: {
    handleClick(item) {
      animate(this.$refs[item.ref], { scale: [1, 1.1, 1] })

      item.action()
    },

    toUser() {
      this.$router.replace("/user")
    },

    toSettings() {
      this.$router.replace("/user/settings")
    },

    logout() {
      this.auth.logout()
      this.$router.replace("/")
    },
  },
}
</script>
