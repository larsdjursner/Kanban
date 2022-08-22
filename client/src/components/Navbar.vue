<template>
  <div
    class="w-screen max-w-screen h-14 min-h-14 max-h-14 border-b py-2 px-4 flex items-center justify-between"
  >
    <div class="w-1/4 h-full">
      <Logo />
    </div>

    <div class="w-1/2 flex">
      <div class="w-2/3">
        <p
          v-if="isBoardNavigation"
          class="text-lg font-semibold"
        >
          {{ currentBoardName }}
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
              <component
                :is="item.icon"
                class="w-4 h-4"
              />
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
import { LogoutIcon, UserIcon, CogIcon, ColorSwatchIcon } from "@heroicons/vue/outline"
import Dropdown from "./menu/Dropdown.vue"
import Logo from "./Logo.vue"

export default {
  components: {
    TextButton,
    Toggle,
    UserIcon,
    Dropdown,
    CogIcon,
    Logo,
  },

  data: () => ({
    store: useStore(),
    auth: useAuth(),

    menu: [],
    logo: null,
  }),

  computed: {
    id() {
      return this.$route.params.id
    },

    currentBoard() {
      return this.store.getCurrentBoard
    },

    currentBoardName() {
      return this.store.currentBoard ? this.store.currentBoard.name : ""
    },

    isBoardNavigation() {
      return "board" === this.$route.name
    },
  },

  created() {
    this.menu = [
      {
        text: "Profile",
        ref: "profile",
        action: () => {
          this.$router.push("/userprofile")
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
          this.$router.push("landing")
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
