<template>
  <v-sheet class="mx-auto" width="300">
    <v-form @submit.prevent="onSubmit" ref="form">
      <v-text-field
        label="Email"
        v-model="email"
        :error-messages="errors['email']"
        v-bind="emailAttrs"
      ></v-text-field>

      <v-text-field
        label="Password"
        v-model="password"
        type="password"
        :error-messages="errors['password']"
        v-bind="passwordAttrs"
      ></v-text-field>

      <v-btn color="primary" type="submit">Submit</v-btn>
      <v-btn color="secondary" @click="resetForm">Reset</v-btn>
    </v-form>
  </v-sheet>
</template>
<script setup lang="ts">
import { useForm } from 'vee-validate';
import * as yup from 'yup';
import { useRouter } from 'vue-router';
import { useAuthStore } from '~/stores/auth';

const router = useRouter();
const authStore = useAuthStore();

const { $snackbar } = useNuxtApp();

const schema = yup.object({
  email: yup
    .string()
    .email('Must be a valid email')
    .required('Email is required'),
  password: yup
    .string()
    .min(6, 'Must be at least 6 characters long')
    .required('Password is required'),
});

const { handleSubmit, errors, defineField, values, resetForm } = useForm({
  validationSchema: schema,
  initialValues: {
    email: '',
    password: '',
  },
});

const onSubmit = handleSubmit(async (values) => {
  try {
    await authStore.login(values);
    router.push('/admin');
  } catch (error) {
    $snackbar.showMessage({ content: 'Login error!', color: 'error' })
  }
});

const resetFormValues = () => {
  resetForm();
};

const [email, emailAttrs] = defineField('email');
const [password, passwordAttrs] = defineField('password');
</script>
