import api from "./api";

export default {
  createSession() {
    return api.get('http://localhost:8000/sanctum/csrf-cookie');
  },

  login(params) {
    return api.post('http://localhost:8000/api/auth/login', params);
  },

  logout() {
    return api.delete('http://localhost:8000/api/auth/logout');
  },

  getPosts() {
    return api.get(`http://localhost:8000/api/v1/posts`);
  },
};
