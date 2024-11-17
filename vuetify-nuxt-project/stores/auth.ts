import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: null,
  }),
  actions: {
    async login({ email, password }) {
      try {
        const data = await $fetch('http://localhost:801/api/login', {
          method: 'POST',
          body: { email, password },
        }).then(response => response.data);

        this.user = data.user;
        this.token = data.token;

        localStorage.setItem('user', JSON.stringify(this.user));
        localStorage.setItem('authToken', JSON.stringify(this.token));
      } catch (err) {
        console.error(err);
        throw new Error('Login falhou');
      }
    },
    logout() {
      this.user = null;
      this.token = null;
      localStorage.removeItem('authToken');
    },
  },
});
