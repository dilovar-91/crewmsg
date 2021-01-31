<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="10" md="5">
      <v-card class="elevation-12">
        <v-toolbar color="primary white--text" flat>
          <v-toolbar-title>{{ $t('login') }}</v-toolbar-title>
          <v-spacer />
        </v-toolbar>
        <v-form
          id="login-form"
          ref="form"
          v-model="valid"
          @submit.prevent="login"
          @keydown="form.onKeydown($event)"
        >
          <v-card-text>
            <v-text-field
              v-model="form.email"
              :label="$t('email')"
              name="login"
              :rules="emailRules"
              prepend-icon="mdi-account"
              type="email"
              required
            />

            <v-text-field
              id="password"
              v-model="form.password"
              :label="$t('password')"
              name="password"
              prepend-icon="mdi-lock"
              type="password"
              required
            />
          </v-card-text>
          <v-card-actions>
            <v-checkbox v-model="remember" class="mt-0" :label="$t('remember_me')" />

            <router-link
              :to="{ name: 'password.request' }"
              class="ml-2 mb-4"
            >
              {{ $t('forgot_password') }}
            </router-link>

            <v-spacer />

            <v-btn
              :disabled="!valid"
              color="primary"
              class="mt-n3"
              :loading="loading"
              form="login-form"
              @click="login()"
            >
              {{ $t('login') }}
            </v-btn>
            <login-with-github />
          </v-card-actions>
          <p>
            <router-link
              :to="{ name: 'register' }"
              class="ml-2 mb-6"
            >
              {{ $t('register') }}
            </router-link>
            <router-link
              :to="{ name: 'home' }"
              class="ml-2 mb-6"
            >
              {{ $t('home') }}
            </router-link>
          </p>
        </v-form>

        <v-snackbar
          v-model="snackbar"
          :color="color"
          :right="'right'"
          :timeout="timeout"
          :top="'top'"
          outlined
        >
          {{ text }}
          <template v-slot:action="{ attrs }">
            <v-btn icon color="deep-orange" @click="snackbar = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </template>
        </v-snackbar>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import Form from 'vform'

export default {
  layout: 'simple',

  head () {
    return { title: this.$t('login') }
  },

  data: () => ({
    loading: false,
    form: new Form({
      email: '',
      password: ''
    }),
    valid: true,
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid'
    ],
    remember: false,

    // snackbar
    color: '',
    snackbar: false,
    text: '',
    timeout: 6000,
    x: null,
    y: 'top'
  }),

  methods: {
    async login () {
      let data
      this.loading = true

      // Submit the form.
      try {
        const response = await this.form.post('/login')
        data = response.data
        this.showSnack('success', 'You successfull logined in')
      } catch (e) {
        let error = e.response.data.message

        if (!error) {
          error = e.response.data.error
        }

        this.showSnack('error', error)
        return
      }

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember,
        role: data.role
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.$router.push('/' + (data.role || '')).catch((error) => {
        if (error.name !== 'NavigationDuplicated') {
          throw error
        }
        console.log(error)
      })
      this.loading = false
    },

    showSnack (type, text) {
      this.text = text
      this.color = type
      this.snackbar = true
    }
  }
}
</script>
