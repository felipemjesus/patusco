import { useSnackbarStore } from '~/stores/snackbar';
export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.provide('snackbar', {
    showMessage({ content = '', color = '' }) {
      const store = useSnackbarStore();
      store.showMessage({ content, color });
    },
  });
});
