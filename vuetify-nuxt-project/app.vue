<template>
  <NuxtLayout>
    <v-app>
      <v-app-bar flat>
        <v-container class="mx-auto d-flex align-center justify-center">
          <v-avatar
            class="me-4 "
            color="grey-darken-1"
            size="32"
          ></v-avatar>

          <v-btn
            v-if="authStore.user"
            v-for="link in links"
            :key="link.name"
            :text="link.name"
            :to="link.path"
            variant="text"
          ></v-btn>

          <v-spacer></v-spacer>

          <v-responsive max-width="250">
            <div v-if="authStore.user" class="float-right">
              <span>Olá, {{ authStore.user.name }}</span>
              <v-btn text color="red" @click="logout">Logout</v-btn>
            </div>
            <v-btn v-else flat class="pink lighten-3 float-right" to="/login">Sign In</v-btn>
          </v-responsive>
        </v-container>
      </v-app-bar>
      <v-main class="bg-grey-lighten-3">
        <v-container>
          <v-row>
            <v-col>
              <v-sheet
                min-height="70vh"
                rounded="lg"
                class="pa-5"
              >
                <Snackbar/>
                <NuxtPage/>
              </v-sheet>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
    </v-app>
  </NuxtLayout>
</template>
<script setup lang="ts">
import { useAuthStore } from '~/stores/auth';
const authStore = useAuthStore();

import { useRouter } from 'vue-router';
const router = useRouter();

const links = [
  {
    name: 'New Marking',
    path: '/',
  },
  {
    name: 'List Markings',
    path: '/admin',
  },
]

const logout = () => {
  authStore.logout();
  router.push('/login')
}
</script>
