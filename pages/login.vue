<template>
  <div class="root">
    <h1>ログイン</h1>

    <form @submit.prevent="login">
      <input
        type="email"
        value=""
        v-model="email"
      >
      <input
        type="password"
        v-model="password"
      >
      <button type="submit">ログイン</button>
    </form>

    <div v-if="errors" style="color: red;">
      <div v-for="error_messages in errors">
        {{ error_messages[0] }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  head: {
    title: 'ログイン'
  },
  data() {
    return {
      email: '',
      password: ''
    };
  },
  async asyncData({ store, redirect }) {
    await store.dispatch('auth/user');
    if (store.state.auth.user) redirect('/');
    return {
      errors: null
    };
  },
  methods: {
    async login() {
      this.$nuxt.$loading.start();
      const { errors } = await this.$store.dispatch('auth/login', {
        email: this.email,
        password: this.password
      });
      if (this.$store.state.auth.user) {
        this.$router.push('/');
      }
      this.$nuxt.$loading.finish();
      this.errors = errors;
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
