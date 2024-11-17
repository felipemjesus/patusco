import { createVuetify } from 'vuetify'
import { VSnackbarQueue } from 'vuetify/labs/VSnackbarQueue'

import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'

export default defineNuxtPlugin((app) => {
  const vuetify = createVuetify({
    components: {
      VSnackbarQueue,
    },
  })
  app.vueApp.use(vuetify)
})
