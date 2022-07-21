module.exports = {
  env: {
    node: true,
  },
  extends: ["eslint:recommended", "plugin:vue/vue3-recommended", "prettier"],
  rules: {
    // override/add rules settings here, such as:
    "vue/no-unused-vars": "error",
    "vue/require-default-prop": "off",
    "vue/multi-word-component-names": "off",
    "vue/no-unused-components": "off",
    "vue/v-on-event-hyphenation": "off",
    "vue/attribute-hyphenation": "off",
  },
}
