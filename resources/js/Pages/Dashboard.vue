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
import API from '@/api'
import Material from 'vuetify/es5/util/colors'
import AppLayout from '@/Layouts/AppLayout'
export default {
  name: 'PageDashboard',
  components: {
    AppLayout
  },
  data: () => ({
    color: Material,
    selectedTab: 'tab-1',
    linearTrending: [
      {
        subheading: 'Sales',
        headline: '2,55',
        caption: 'increase',
        percent: 15,
        icon: {
          label: 'mdi-trending-up',
          color: 'success'
        },
        linear: {
          value: 15,
          color: 'success'
        }
      },
      {
        subheading: 'Revenue',
        headline: '6,553',
        caption: 'increase',
        percent: 10,
        icon: {
          label: 'mdi-trending-down',
          color: 'error'
        },
        linear: {
          value: 15,
          color: 'error'
        }
      },
      {
        subheading: 'Orders',
        headline: '5,00',
        caption: 'increase',
        percent: 50,
        icon: {
          label: 'mdi-arrow-up',
          color: 'info'
        },
        linear: {
          value: 50,
          color: 'info'
        }
      }
    ],
    trending: [
      {
        subheading: 'Email',
        headline: '15+',
        caption: 'email opens',
        percent: 15,
        icon: {
          label: 'mdi-email-open',
          color: 'info'
        },
        linear: {
          value: 15,
          color: 'info'
        }
      },
      {
        subheading: 'Tasks',
        headline: '90%',
        caption: 'tasks completed.',
        percent: 90,
        icon: {
          label: 'mdi-view-list',
          color: 'primary'
        },
        linear: {
          value: 90,
          color: 'success'
        }
      },
      {
        subheading: 'Issues',
        headline: '100%',
        caption: 'issues fixed.',
        percent: 100,
        icon: {
          label: 'mdi-bug',
          color: 'primary'
        },
        linear: {
          value: 100,
          color: 'error'
        }
      }
    ]
  }),
  computed: {
    activity() {
      return [
        {
          avatar:
            'https://s3.amazonaws.com/uifaces/faces/twitter/ludwiczakpawel/128.jpg',
          timeString: 'Just now',
          color: 'primary',
          text: 'Michael finished  one task just now.'
        },
        {
          avatar:
            'https://s3.amazonaws.com/uifaces/faces/twitter/suprb/128.jpg',
          timeString: '30 min ago',
          color: 'teal',
          text: 'Jim created a new  task.'
        },
        {
          avatar:
            'https://s3.amazonaws.com/uifaces/faces/twitter/suprb/128.jpg',
          timeString: '1 hour ago',
          color: 'indigo',
          text: 'Li completed the PSD to html convert.'
        },
        {
          avatar:
            'https://s3.amazonaws.com/uifaces/faces/twitter/suprb/128.jpg',
          timeString: '3 hour ago',
          color: 'pink',
          text: 'Michael upload a new pic.'
        },
        {
          avatar:
            'https://s3.amazonaws.com/uifaces/faces/twitter/suprb/128.jpg',
          timeString: '10 min ago',
          color: 'cyan',
          text: 'Li assigned a a task to Michael'
        }
      ]
    },
    siteTrafficData() {
      return API.getMonthVisit
    },
    locationData() {
      return API.getLocation
    }
  }
}
</script>
