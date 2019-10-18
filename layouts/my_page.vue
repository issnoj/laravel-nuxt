<template>
  <div class="root">
    <header>
      <h1>
        <nuxt-link to="/">Laravel + Nuxt.js</nuxt-link>
      </h1>
    </header>

    <div class="a">
      <aside>
        <span class="user_email">{{ user.email }}</span>
        <form @submit.prevent="logout">
          <button type="submit">ログアウト</button>
        </form>
      </aside>
      <main>
        <nuxt />
      </main>
    </div>
  </div>
</template>

<script>
import UserProfile from '../components/UserProfile';

export default {
  components: { UserProfile },
  middleware: 'auth',
  computed: {
    user() {
      return this.$store.state.auth.user;
    }
  },
  methods: {
    async logout() {
      this.$nuxt.$loading.start();
      const { message, errors } = await this.$store.dispatch('auth/logout');
      this.$nuxt.$loading.finish();
      if (!this.$store.state.auth.user) {
        this.$router.push('/');
      }
      this.message = message;
      this.errors = errors;
    }
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
  text-align: center;
}

.a {
  display: grid;
  gap: 10px;
  grid-template-columns: minmax(180px, 350px) 1fr;

  main {
    background: #f0eeee;
  }

  aside {
    background: #eeeefe;
  }
}
</style>
