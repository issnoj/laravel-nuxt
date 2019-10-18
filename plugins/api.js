import axios from 'axios';

// 初期化
const init = () => {
  axios.defaults.baseURL = 'http://local.stack-rack.com/api';
  axios.interceptors.request.use((config) => {
    if (_token.get()) {
      config.headers.common['Authorization'] = 'Bearer ' + _token.get();
    }
    return config;
  });
};

// トークン管理
const _token = {
  get: () => localStorage.getItem('token'),
  set: (token) => localStorage.setItem('token', token),
  del: () => localStorage.removeItem('token')
};

// エラー管理
const _error = {
  get(err) {
    if (err.response && err.response.data && err.response.data.errors) {
      return err.response.data.errors;
    }
    console.error(err);
    return { unknown: ['エラーが発生しました'] };
  }
};

// ログイン
const login = async (email, password) => {
  const { user, token, errors } = await axios.post('/login', { email, password })
    .then(res => ({ user: res.data.user, token: res.data.token }))
    .catch(err => ({ errors: _error.get(err) }));
  _token.set(token);
  return { user, errors };
};

// ログイン済ユーザー
const user = async () => {
  const { user, errors } = await axios.get('/user')
    .then(res => ({ user: res.data.user }))
    .catch(err => ({ errors: _error.get(err) }));
  return { user, errors };
};

// ログアウト
const logout = async () => {
  const { message, errors } = await axios.post('/logout')
    .then(res => ({ message: res.data.message }))
    .catch(err => ({ errors: _error.get(err) }));
  _token.del();
  return { message, errors };
};

// 新規登録
const register = async (email, password, password_confirmation) => {
  const { user, token, errors } = await axios.post('/register', { email, password, password_confirmation })
    .then((res) => ({ user: res.data.user, token: res.data.token }))
    .catch((err) => ({ errors: _error.get(err) }));
  _token.set(token);
  return { user, errors };
};

export default ({ app }, inject) => {
  init();
  inject('api', {
    login,
    user,
    logout,
    register
  });
}
