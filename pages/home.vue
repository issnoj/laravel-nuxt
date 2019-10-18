<template>
  <div class="root">
    <h1>マイページ</h1>
  </div>
</template>

<script>
export default {
  head: {
    title: 'ホーム'
  },
  layout: 'my_page',
  computed: {
    user() {
      return this.$store.state.auth.user;
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
