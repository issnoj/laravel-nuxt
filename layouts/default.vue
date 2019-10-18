<template>
  <div class="root">
    <header>
      <h1>Laravel + Nuxt.js</h1>
      <UserProfile :loading="$store.state.auth.guest === null" :user="user" class="UserProfile" />
    </header>

    <main>
      <nuxt />
    </main>
  </div>
</template>

<script>
import UserProfile from '../components/UserProfile';

export default {
  components: { UserProfile },
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
.root {
  margin: 0 auto;
  max-width: 1200px;
}

header {
  height: 50px;
  position: relative;
  text-align: center;

  .UserProfile {
    height: 40px;
    position: absolute;
    right: 0;
    top: 5px;
  }
}

main {
  background: #f0eeee;
}
</style>
