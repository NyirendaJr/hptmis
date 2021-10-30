<template>
    <app-layout>
      <div class="page-dashboard">
        <v-container>
            <h1>Start Building Your Professional Dashboard here</h1>
        </v-container>
      </div>
    </app-layout>
</template>


<script>
import * as API from '@/api/api'
import Material from 'vuetify/es5/util/colors'
import AppLayout from '@/Layouts/AppLayout'
export default {
  name: 'PageDashboard',
  components: {
    AppLayout
  },
  data: () => ({
  }),
}
</script>
