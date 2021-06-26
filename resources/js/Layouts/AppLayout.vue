<template>
  <v-app dark>
    <!-- content center -->
    <div class="admin">
      <app-drawer ref="drawer" class="admin_drawer" @drawer:collapsed="mini = !mini" />
      <app-toolbar class="admin_toolbar" extended @side-icon-click="handleDrawerVisiable" />
      <v-main class="grey lighten-3">
        <!-- Page Wrapper -->
        <div class="page_wrapper">
          <slot></slot>
        </div>
        <!-- App Footer -->
        <v-footer height="auto" class="pa-3 app--footer">
          <span>isocked.com Design &copy; {{ new Date().getFullYear() }}</span>
          <v-spacer />
          <span class="caption mr-1">Make With Love</span>
          <v-icon color="pink" small>mdi-heart</v-icon>
        </v-footer>
      </v-main>
      <!-- Go to top -->
      <app-fab />
    </div>
    <!-- theme setting -->
    <v-btn small fab dark fixed top="top" right="right" class="setting-fab" color="red" @click="openThemeSettings">
      <v-icon>mdi-silverware-variant</v-icon>
    </v-btn>
    <v-btn small fab dark fixed top="top" right="right" class="chat-fab" color="primary" @click="openOnlineUser">
      <v-icon>mdi-chat</v-icon>
    </v-btn>
    <!-- setting drawer -->
    <v-navigation-drawer v-model="rightDrawer" class="setting-drawer" temporary right hide-overlay fixed>
      <template v-if="showSetting">
        <theme-settings />
      </template>
      <template v-else>
        <online-user />
      </template>
    </v-navigation-drawer>
    <!-- global snackbar -->
    <v-snackbar v-model="snackbar.show" :timeout="3000" app top centered :color="snackbar.color">
      {{ snackbar.text }}
      <template #action="{ attrs }">
        <v-btn icon v-bind="attrs" @click="$store.commit('HIDE_SNACKBAR')">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </template>
    </v-snackbar>
  </v-app>
</template>

<script>
import ThemeSettings from '@/components/ThemeSettings'
import OnlineUser from '@/components/OnlineUser'
// import LayoutDefault from '@/components/layouts/LayoutDefault'
import AppDrawer from '@/components/AppDrawer'
import AppToolbar from '@/components/AppToolbar'
import AppFab from '@/components/AppFab'
import { mapGetters } from 'vuex'
export default {
  components: {
    ThemeSettings,
    OnlineUser,
    // LayoutDefault
    AppDrawer,
    AppToolbar,
    AppFab,
  },
  data() {
    return {
      rightDrawer: false,
      showSetting: true,
      mini: false,
      showDrawer: true,
    }
  },
  computed: {
    ...mapGetters(['getSnackbar']),
    snackbar: {
      get() {
        return this.getSnackbar
      },
      set(val) {
        this.$store.commit('UPDATE_SNACKBAR', val)
      },
    },
  },
  mounted() {
    if (typeof window !== undefined && window._VMA === undefined) {
      window._VMA = this
    }
  },
  created() {},
  methods: {
    openThemeSettings() {
      this.$vuetify.goTo(0)
      this.showSetting = true
      this.rightDrawer = !this.rightDrawer
    },
    openOnlineUser() {
      this.$vuetify.goTo(0)
      this.showSetting = false
      this.rightDrawer = !this.rightDrawer
    },
    handleDrawerVisiable() {
      this.$refs.drawer.toggleDrawer()
    },
  },
}
</script>

<style lang="sass" scoped>
.setting-fab
  top: 50% !important
  right: 0
  border-radius: 0
.chat-fab
  top: calc(50% + 40px) !important
  right: 0
  border-radius: 0
.page_wrapper
  min-height: calc(100vh - 112px - 48px)
  padding-top: 35px
.container
  max-width: 1200px
</style>
