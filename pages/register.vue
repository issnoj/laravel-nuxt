<template>
  <div class="root">
    <h1>新規登録</h1>

    <form @submit.prevent="register">
      <input
        type="email"
        value=""
        v-model="email"
      >
      <input
        type="password"
        v-model="password"
      >
      <input
        type="password"
        v-model="password_confirmation"
      >
      <button type="submit">新規登録</button>
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
    title: '新規登録'
  },
  data() {
    return {
      email: '',
      password: '',
      password_confirmation: ''
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
    async register() {
      this.$nuxt.$loading.start();
      const { errors } = await this.$store.dispatch('auth/register', {
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
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
