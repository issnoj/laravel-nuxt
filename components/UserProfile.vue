<template>
  <div class="root">
    <div v-if="loading">
      <ALoading />
    </div>

    <div v-else-if="user">
      <nuxt-link to="/home">マイページ</nuxt-link>
      <button @click="logout">ログアウト</button>
    </div>

    <div v-else>
      <nuxt-link to="/login">ログイン</nuxt-link>
      <nuxt-link to="/register">新規登録</nuxt-link>
      <nuxt-link to="/home">マイページ</nuxt-link>
    </div>
  </div>
</template>

<script>
import ALoading from './atoms/ALoading';

export default {
  name: 'UserProfile',
  components: { ALoading },
  props: {
    user: {
      type: Object,
      default() {
        return {};
      }
    },
    loading: {
      type: Boolean,
      default() {
        return true;
      }
    }
  },
  methods: {
    async logout() {
      this.$nuxt.$loading.start();
      const { message, errors } = await this.$store.dispatch('auth/logout');
      this.$nuxt.$loading.finish();
      this.message = message;
      this.errors = errors;
    }
  }
};
</script>

<style lang="scss" scoped>
.root {
  border: 1px solid gray;
  padding: 5px;
  display: flex;
  align-items: center;
}
</style>
