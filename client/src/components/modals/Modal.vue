<template>
  <Presence>
    <Motion
      v-show="showModal"
      :initial="{ opacity: 0 }"
      :animate="{ opacity: 1 }"
      :exit="{ opacity: 0 }"
      class="z-50"
    >
      <div class="fixed z-50 h-full w-full bg-black/70" @click="closeModal">
        <div
          class="fixed top-1/2 left-1/2 z-50 -translate-x-1/2 -translate-y-1/2 h-1/2 w-1/2"
          @click.stop
        >
          <Presence>
            <Motion
              :initial="{ opacity: 0, scale: 0 }"
              :animate="{ opacity: 1, scale: 1 }"
              :exit="{ opacity: 0, scale: 0.6 }"
            >
              <div
                class="flex flex-col gap-8 rounded-xl overflow-hidden bg-white"
              >
                <div class="flex flex-col">
                  <!-- header -->
                  <div class="flex shadow-md p-4">
                    <p class="font-semibold text-xl">
                      <slot name="header" />
                    </p>
                    <span class="flex-1" />
                    <button @click="closeModal">
                      <XIcon class="h-4 w-4" />
                    </button>
                  </div>

                  <!-- content -->
                  <div class="shadow-md">
                    <slot name="content" />
                  </div>

                  <!-- footer -->
                  <div class="mt-4">
                    <slot name="footer" />
                  </div>
                </div>
              </div>
            </Motion>
          </Presence>
        </div>
      </div>
    </Motion>
  </Presence>
</template>

<script>
import { Presence, Motion } from "@motionone/vue"
import { XIcon } from "@heroicons/vue/outline"

export default {
  components: { Presence, Motion, XIcon },

  props: {
    showModal: {
      type: Boolean,
      default: false,
    },
  },

  emits: ["closeModal"],

  methods: {
    closeModal() {
      this.$emit("closeModal")
    },
  },
}
</script>
