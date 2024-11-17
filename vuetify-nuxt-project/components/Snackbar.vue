<template>
  <v-snackbar v-model="visible" :color="color" :timeout="3000">
    <div class="d-flex justify-space-between">
      <span class="pa-2">{{ message }}</span>
      <v-btn icon="$close" size="x-small" color="white" @click="visible = false" />
    </div>
  </v-snackbar>
</template>

<script setup>
import { useSnackbarStore } from '~/stores/snackbar';

const store = useSnackbarStore();
const visible = computed(() => store.visible);
const message = computed(() => store.message);
const color = computed(() => store.color);
</script>
