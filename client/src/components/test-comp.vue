<template>
  <p>{{ myProp }}</p>
</template>

<script>
export default {
  props: {
    myProp: {
      type: String,
    },
  },
}
</script>
