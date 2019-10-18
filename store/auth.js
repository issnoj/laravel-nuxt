export const state = () => ({
  user: null,
  guest: null
});

export const getters = {};

export const mutations = {
  user(state, value) {
    state.user = value;
  },
  guest(state, value) {
    state.guest = value;
  }
};

export const actions = {
  async user({ state, commit }) {
    if (!state.guest && !state.user) {
      const { user } = await this.$api.user();
      if (user) {
        commit('user', user);
        commit('guest', false);
      } else {
        commit('guest', true);
      }
    }
  },
  async login({ commit }, { email, password }) {
    const { user, errors } = await this.$api.login(email, password);
    if (user) {
      commit('user', user);
      commit('guest', false);
    }
    return { errors };
  },
  async logout({ commit }) {
    const { message, errors } = await this.$api.logout();
    if (!errors) {
      commit('user', null);
      commit('guest', true);
    }
    return { message, errors };
  },
  async register({ commit }, { email, password, password_confirmation }) {
    const { user, errors } = await this.$api.register(email, password, password_confirmation);
    if (!errors) {
      commit('user', user);
      commit('guest', false);
    }
    return { errors };
  }
};
