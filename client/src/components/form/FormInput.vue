<template>
  <div class="flex flex-col justify-between gap-2 h-20">
    <p class="text-lg">{{ text }}</p>

    <div class="flex relative h-12">
      <input
        ref="input"
        class="rounded-md h-full w-full p-4 shadow-md"
        :required="required"
        :value="modelValue"
        :placeholder="placeholder"
        :type="showPassword || !password ? 'text' : 'password'"
        @input="$emit('update:modelValue', $event.target.value)"
      />
      <button v-if="password" class="absolute bottom-4 right-4" @click="show">
        <EyeOffIcon v-if="showPassword" class="h-4 w-4" />
        <EyeIcon v-else class="h-4 w-4" />
      </button>
    </div>
  </div>
</template>

<script>
import { EyeOffIcon, EyeIcon } from "@heroicons/vue/outline"
export default {
  components: { EyeIcon, EyeOffIcon },

  props: {
    modelValue: {
      type: String,
      required: true,
    },

    text: {
      type: String,
      required: true,
    },

    placeholder: {
      type: String,
      required: true,
    },

    password: {
      type: Boolean,
      default: false,
    },

    required: {
      type: Boolean,
      default: false,
    },

    focus: {
      type: Boolean,
      default: false,
    },
  },

  emits: ["update:modelValue"],

  data: () => ({
    showPassword: false,
  }),

  mounted() {
    if (focus) {
      this.$refs.input.focus()
    }
  },

  methods: {
    show() {
      this.showPassword = !this.showPassword

      const end = this.$refs.input.value.length

      this.$refs.input.focus()
      this.$refs.input.setSelectionRange(end, end)
    },
  },
}
</script>
