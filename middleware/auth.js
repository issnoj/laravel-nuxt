export default async ({ store, redirect }) => {
  await store.dispatch('auth/user');
  if (!store.state.auth.user) {
    return redirect('/login');
  }
}
