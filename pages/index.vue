<template>
  <div class="root">
    <h1>トップページ</h1>
  </div>
</template>

<script>
import UserProfile from '../components/UserProfile';

export default {
  components: { UserProfile },
  head: {
    titleTemplate: null,
    meta: [
      {
        hid: 'og:type',
        name: 'og:type',
        property: 'og:type',
        content: 'website'
      }
    ]
  },
  data() {
    return {
      message: null,
      errors: null
    };
  },
  computed: {
    user() {
      return this.$store.state.auth.user;
    }
  },
  asyncData({ store }) {
    store.dispatch('auth/user');
  }
};
</script>

<style lang="scss" scoped>

</style>
