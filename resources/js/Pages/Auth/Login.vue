<template>
  <v-app class="layout-auth primary">
    <v-main>
      <v-container class="page-login" fill-height>
        <v-row>
          <v-col :cols="12">
            <v-card class="pa-3 page-login__card" tile>
              <v-card-title>
                <img src="/static/m.png" alt="Vue Material Admin" height="48" contain />
                <div class="primary--text display-1">Material Admin Template</div>
              </v-card-title>
              <v-card-text>
                <v-alert type="success"> {{ $t('login_account') }} : admin/admin </v-alert>
                <v-form ref="form" v-model="formValid" class="my-10" lazy-validation>
                  <v-text-field
                    v-model="form.email"
                    append-icon="mdi-email"
                    autocomplete="off"
                    name="login"
                    :label="$t('email')"
                    :placeholder="$t('email')"
                    type="text"
                    required
                    outlined
                    :rules="formRule.email"
                  />
                  <v-text-field
                    v-model="form.password"
                    append-icon="mdi-lock"
                    autocomplete="off"
                    name="password"
                    :label="$t('password')"
                    :placeholder="$t('password')"
                    type="password"
                    :rules="formRule.password"
                    required
                    outlined
                    @keyup.enter="handleLogin"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-tooltip v-for="item in socialIcons" :key="item.text" bottom>
                  <template #activator="{ on, attrs }">
                    <v-btn color="primary" icon v-bind="attrs" v-on="on" @click="handleSocialLogin">
                      <v-icon v-text="item.icon" />
                    </v-btn>
                  </template>
                  <span>{{ item.text }}</span>
                </v-tooltip>
                <v-spacer />
                <!-- <v-btn large text @click="handleRegister">
                  {{ $t('register') }}
                </v-btn> -->
                <v-btn large tile color="primary" :loading="loading" @click="handleLogin">
                  {{ $t('login') }}
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
const name = 'page-login'
export default {
  name: name,
  data() {
    return {
      loading: false,
      formValid: false,
      formModel: {
        username: 'admin',
        password: 'admin',
      },
      form: this.$inertia.form({
          email: '',
          password: '',
          remember: false
      }),
      formRule: {
        email: [(v) => !!v || this.$t('rule.required', ['email'])],
        password: [(v) => !!v || this.$t('rule.required', ['password'])],
      },
      socialIcons: [
        {
          text: 'Google',
          icon: 'mdi-google',
        },
        {
          text: 'Facebook',
          icon: 'mdi-facebook',
        },
        {
          text: 'Twitter',
          icon: 'mdi-twitter',
        },
      ],
    }
  },
  computed: {},
  methods: {
    handleLogin() {
      if (this.$refs.form.validate()) {
        this.loading = true
        this.form
          .transform(data => ({
              ...data,
              remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
              onFinish: () => this.form.reset('password'),
          })
      }
    },
    handleSocialLogin() {},
  },
}
</script>

<style lang="sass" scoped>
.page-login
  &__card
  max-width: 600px
  margin: 0 auto

.layout-auth
  height: 50%
  width: 100%
  position: absolute
  top: 0
  left: 0
  content: ""
  z-index: 0
</style>
