<template>
  <v-row>
    <v-col>
      <v-text-field
        label="Date"
        type="date"
        v-model="date"
      ></v-text-field>
    </v-col>
    <v-col>
      <v-select
        label="Animal Type"
        v-model="animalType"
        :items="animalTypes"
        item-value="id"
        item-title="name"
      ></v-select>
    </v-col>
    <v-col cols="1">
      <v-btn size="small" color="primary" @click="filterMarking">Filter</v-btn>
      <v-btn size="small" color="secondary" @click="resetFilterMarking">Reset</v-btn>
    </v-col>
  </v-row>
  <v-data-table-server
    :headers="headers"
    :items="serverItems"
    :items-length="totalItems"
    :loading="loading"
    @update:options="loadItems"
  >
    <template v-slot:item.actions="{ item }">
      <v-btn
        icon
        color="primary"
        size="x-small"
        @click="editItem(item)"
      >
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
      <v-btn
        icon
        color="red"
        size="x-small"
        @click="deleteItem(item)"
        v-if="isDelete"
      >
        <v-icon>mdi-delete</v-icon>
      </v-btn>
    </template>
  </v-data-table-server>
</template>
<script setup lang="ts">
definePageMeta({
  middleware: [
    'auth',
  ],
});

import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '~/stores/auth';

const { $snackbar } = useNuxtApp();
const router = useRouter();
const authStore = useAuthStore();

const isDelete = computed(() => {
  return ['admin', 'receptionist'].includes(authStore.user.role);
})

const date = ref('');
const animalType = ref('');

const animalTypes = await $fetch('http://localhost:801/api/animal-types').then((response) => response.data);

const headers = [
  { title: 'Date', key: 'date' },
  { title: 'Tutor', key: 'animal.tutor.name' },
  { title: 'Email', key: 'animal.tutor.email' },
  { title: 'Animal', key: 'animal.name' },
  { title: 'Animal Type', key: 'animal.animal_type.name' },
  { title: 'Doctor', key: 'user.name' },
  { title: 'Actions', value: 'actions' },
];

const loading = ref(false);
const serverItems = ref([]);
const totalItems = ref([]);

const loadItems = async ({ page, itemsPerPage, sortBy, date, animal_type }) => {
  loading.value = true
  await $fetch('http://localhost:801/api/markings', {
    headers: { Authorization: `Bearer ${authStore.token}` },
    params: { page, itemsPerPage, sortBy, date, animal_type },
  }).then((response) => {
    serverItems.value = response.data
    totalItems.value = response.meta.total;
    loading.value = false
  })
};

const filterMarking = async () => {
  await loadItems({
    page: 1,
    itemsPerPage: 10,
    sortBy: null,
    date: date.value,
    animal_type: animalType.value
  });
};

const resetFilterMarking = async () => {
  date.value = '';
  animalType.value = '';
  await loadItems({
    page: 1,
    itemsPerPage: 10,
    sortBy: null,
    date: null,
    animal_type: null
  });
}

const editItem = (item) => {
  router.push(`/admin/markings/${item.id}`);
};

const deleteItem = async (item) => {
  await $fetch(`http://localhost:801/api/markings/${item.id}`, {
    headers: { Authorization: `Bearer ${authStore.token}` },
    method: 'DELETE',
  }).then(async (response) => {
    $snackbar.showMessage({ content: 'Marking deleted successfully!', color: 'success' });
    await loadItems({
      page: 1,
      itemsPerPage: 10,
      sortBy: null,
      date: null,
      animal_type: null
    });
  });
};
</script>
