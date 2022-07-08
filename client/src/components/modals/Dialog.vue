<template>
  <Presence>
    <Motion
      v-show="showDialog"
      :initial="{ opacity: 0 }"
      :animate="{ opacity: 1 }"
      :exit="{ opacity: 0 }"
      class="z-50"
    >
      <div class="fixed z-50 h-full w-full bg-black/60" @click="closeDialog">
        <div
          class="fixed top-1/2 left-1/2 z-50 -translate-x-1/2 -translate-y-1/2"
          @click.stop
        >
          <Presence>
            <Motion
              :initial="{ opacity: 0, scale: 0 }"
              :animate="{ opacity: 1, scale: 1 }"
              :exit="{ opacity: 0, scale: 0.6 }"
            >
              <div
                class="flex flex-col gap-8 rounded-xl bg-white overflow-hidden"
              >
                <div class="flex flex-col">
                  <!-- header -->
                  <div class="flex shadow-md p-4">
                    <p class="font-semibold text-xl">
                      <slot name="header" />
                    </p>
                  </div>

                  <!-- content -->
                  <slot name="content" />

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

export default {
  components: { Presence, Motion },

  props: {
    showDialog: {
      type: Boolean,
      default: false,
    },
  },

  emits: ["closeDialog"],

  methods: {
    closeDialog() {
      this.$emit("closeDialog")
    },
  },
}
</script>
