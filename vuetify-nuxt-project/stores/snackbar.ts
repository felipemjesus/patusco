import { defineStore } from 'pinia';

export const useSnackbarStore = defineStore('snackbar', {
  state: () => ({
    visible: false,
    message: '',
    color: 'success', // Padrão
  }),
  actions: {
    showMessage({ content, color }) {
      this.message = content;
      this.color = color;
      this.visible = true;

      // Esconde automaticamente após 3 segundos
      setTimeout(() => {
        this.visible = false;
      }, 3000);
    },
  },
});
