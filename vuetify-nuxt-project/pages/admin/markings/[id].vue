<template>
  <v-sheet class="mx-auto" width="300">
    <v-form @submit.prevent="onSubmit" ref="form">
      <v-text-field
        label="Animal Name"
        v-model="animalName"
        :error-messages="errors['animal.name']"
        v-bind="animalNameAttrs"
      ></v-text-field>

      <v-text-field
        label="Animal Age"
        v-model="animalAge"
        type="number"
        :error-messages="errors['animal.age']"
        v-bind="animalAgeAttrs"
      ></v-text-field>

      <v-select
        label="Animal Type"
        v-model="animalType"
        :items="animalTypes"
        item-value="id"
        item-title="name"
        :error-messages="errors['animal.animal_type.id']"
        v-bind="animalTypeAttrs"
      ></v-select>

      <v-text-field
        label="Tutor Name"
        v-model="tutorName"
        :error-messages="errors['animal.tutor.name']"
        v-bind="tutorNameAttrs"
      ></v-text-field>

      <v-text-field
        label="Tutor Email"
        v-model="tutorEmail"
        :error-messages="errors['animal.tutor.email']"
        v-bind="tutorEmailAttrs"
      ></v-text-field>

      <v-textarea
        label="Symptoms"
        v-model="symptoms"
        :error-messages="errors.symptoms"
        v-bind="symptomsAttrs"
      ></v-textarea>

      <v-text-field
        label="Date"
        type="date"
        v-model="date"
        :error-messages="errors.date"
        v-bind="dateAttrs"
      ></v-text-field>

      <v-text-field
        label="Hour"
        type="time"
        v-model="hour"
        :error-messages="errors.hour"
        v-bind="hourAttrs"
      ></v-text-field>

      <v-select
        label="Doctor"
        v-model="doctor"
        :items="doctors"
        item-value="id"
        item-title="name"
        :error-messages="errors['user.id']"
        v-bind="doctorAttrs"
      ></v-select>

      <v-btn color="primary" type="submit">Submit</v-btn>
      <v-btn color="secondary" @click="cancelForm">Cancel</v-btn>
    </v-form>
  </v-sheet>
</template>
<script setup lang="ts">
definePageMeta({
  middleware: [
    'auth',
  ],
});

import { useRouter } from "vue-router";
const router = useRouter();

import dayjs from 'dayjs';
import { useForm } from 'vee-validate';
import * as yup from 'yup';

import { useAuthStore } from '~/stores/auth';
const authStore = useAuthStore();

const { $snackbar } = useNuxtApp();

const animalTypes = await $fetch('http://localhost:801/api/animal-types').then((response) => response.data);

const doctors = await $fetch('http://localhost:801/api/users', {
  headers: { Authorization: `Bearer ${authStore.token}` },
  params: { role: 'doctor' },
}).then((response) => response.data);

const { id } = useRoute().params
const marking = await $fetch(`http://localhost:801/api/markings/${id}`, {
  headers: { Authorization: `Bearer ${authStore.token}` },
}).then((response) => {
  return {
    ...response.data,
    date: dayjs(response.data.date).format('YYYY-MM-DD'),
    hour: dayjs(response.data.hour).format('HH:mm'),
  };
});

const schema = yup.object({
  animal: yup.object({
    name: yup.string().required('Animal name is required'),
    age: yup
      .number()
      .min(0, 'Age must be a positive number')
      .required('Animal age is required'),
    animal_type: yup.object({
      id: yup.number().required('Animal type is required'),
    }),
    tutor: yup.object({
      name: yup.string().required('Tutor name is required'),
      email: yup
        .string()
        .email('Must be a valid email')
        .required('Tutor email is required'),
    }),
  }),
  symptoms: yup.string().required('Symptoms are required'),
  date: yup.date().required('Marking date is required'),
  hour: yup.string().required('Marking hour is required'),
  user: yup.object({
    id: yup.number().nullable(),
  }),
});

const { handleSubmit, errors, defineField, values, resetForm } = useForm({
  validationSchema: schema,
  initialValues: marking,
});

const onSubmit = handleSubmit(async (values) => {
  await $fetch(`http://localhost:801/api/markings/${id}`, {
    headers: { Authorization: `Bearer ${authStore.token}` },
    method: 'PUT',
    body: JSON.stringify(values),
  }).then(response => {
    $snackbar.showMessage({ content: 'Marking update successfully!', color: 'success' })
    router.push('/admin/markings');
  }).catch(error => {
    $snackbar.showMessage({ content: 'Marking error!', color: 'error' })
  })
});

const cancelForm = () => {
  router.push('/admin/markings');
}

const [animalName, animalNameAttrs] = defineField('animal.name');
const [animalAge, animalAgeAttrs] = defineField('animal.age');
const [animalType, animalTypeAttrs] = defineField('animal.animal_type.id');
const [tutorName, tutorNameAttrs] = defineField('animal.tutor.name');
const [tutorEmail, tutorEmailAttrs] = defineField('animal.tutor.email');
const [symptoms, symptomsAttrs] = defineField('symptoms');
const [date, dateAttrs] = defineField('date');
const [hour, hourAttrs] = defineField('hour');
const [doctor, doctorAttrs] = defineField('user.id');
</script>
