<template>
  <v-app-bar color="primary" dark app flat>
    <v-app-bar-nav-icon @click="handleDrawerToggle" />
    <v-spacer />
    <v-toolbar-items>
      <!--<v-menu offset-y origin="center center" class="elelvation-1" transition="scale-transition">
        <template #activator="{ on }">
          <v-btn slot="activator" icon text v-on="on">
            <v-badge color="red" overlap>
              <span slot="badge">{{ getNotification.length }}</span>
              <v-icon medium>mdi-bell</v-icon>
            </v-badge>
          </v-btn>
        </template>
        <notification-list v-show="getNotification.length > 0" :items="getNotification" />
      </v-menu>-->
      <!-- locale -->
      <!--<LocaleSwitch />-->
      <v-menu offset-y origin="center center" transition="scale-transition">
        <template #activator="{ on }">
          <v-btn slot="activator" icon large text v-on="on">
            <c-avatar :size="36" :username="getUsername" :src="getAvatar" status="online" />
          </v-btn>
        </template>
        <v-list class="pa-0">
          <v-list-item
            v-for="(item, index) in profileMenus"
            :key="index"
            :disabled="item.disabled"
            :target="item.target"
            rel="noopener"
            @click="item.click"
          >
            <v-list-item-action v-if="item.icon">
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-toolbar-items>
    <!--<v-toolbar v-if="extended" slot="extension" tag="div" dense color="white" light>
      <v-icon>mdi-home</v-icon>
      <v-breadcrumbs :items="breadcrumbs" class="pa-3" />
      <v-spacer></v-spacer>
      <v-btn icon small color="black">
        <v-icon @click="handleGoBack" v-text="'mdi-arrow-left'" />
      </v-btn>
    </v-toolbar>-->
  </v-app-bar>
</template>
<script>
//import NotificationList from '@/components/list/NotificationList'
//import LocaleSwitch from '@/components/locale/LocaleSwitch'
import CAvatar from '@/components/avatar/CAvatar'
import Util from '@/util'
import { mapGetters } from 'vuex'
export default {
  name: 'AppToolbar',
  components: {
    //LocaleSwitch,
    //NotificationList,
    CAvatar,
  },
  props: {
    extended: Boolean,
  },
  data() {
    return {
      profileMenus: [
        {
          icon: 'mdi-account',
          href: '#',
          title: 'Profile',
          click: this.handleProfile,
        },
        {
          icon: 'mdi-cog',
          href: '#',
          title: 'Settings',
          click: this.handleSetting,
        },
        {
          icon: 'mdi-power',
          href: '#',
          title: 'Logout',
          click: this.handleLogut,
        },
      ],
    }
  },
  computed: {
    ...mapGetters(['getAvatar', 'getUsername', 'getNotification']),
  },
  created() {},
  methods: {
    handleDrawerToggle() {
      this.$emit('side-icon-click')
    },
    handleLogut() {
      this.$inertia.post(route('logout'));
    },

    handleSetting() {},
    handleProfile() {},
    handleGoBack() {
      this.$router.go(-1)
    },
  },
}
</script>
