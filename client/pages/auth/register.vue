<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="8" md="4">
      <v-card class="elevation-12">
        <v-toolbar color="primary" dark flat>
          <v-toolbar-title v-if="mustVerifyEmail">
            {{ $t('register') }}
            <div class="alert alert-success" role="alert">
              {{ $t('verify_email_address') }}
            </div>
          </v-toolbar-title>
          <v-toolbar-title v-else>
            {{ $t('register') }}
          </v-toolbar-title>

          <v-spacer />
        </v-toolbar>
        <v-form id="register-form" ref="form" v-model="valid" lazy-validation>
          <v-card-text>
            <v-text-field
              v-model="form.name"
              :label="$t('name')"
              name="name"
              prepend-icon="mdi-account"
              :rules="nameRules"
              type="text"
              autocomplete="name"
              required
            />
            <v-text-field
              v-model="form.email"
              :label="$t('email')"
              :rules="emailRules"
              name="email"
              prepend-icon="mdi-email"
              type="email"
              autocomplete="email"
              required
            />

            <v-text-field
              id="password"
              ref="password"
              v-model="form.password"
              :append-icon="show ? 'mdi-eye-outline' : 'mdi-eye-off-outline'"
              :label="$t('password')"
              name="password"
              :rules="[min, password]"
              prepend-icon="mdi-lock"
              :type="show ? 'text' : 'password'"
              required
              autocomplete="new-password"
              @click:append="show = !show"
            />
            <v-text-field
              id="confirm_password"
              v-model="form.password_confirmation"
              :append-icon="show1 ? 'mdi-eye-outline' : 'mdi-eye-off-outline'"
              :label="$t('confirm_password')"
              name="confirm_password"
              prepend-icon="mdi-lock"
              :type="show1 ? 'text' : 'password'"
              :rules="[min, password, passwordConfirmationRule]"
              required
              autocomplete="new-password"
              @click:append="show1 = !show1"
            />
          </v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn color="primary" form="register-form" :loading="loading" @click="register()">
              {{ $t('register') }}
            </v-btn>
            <!-- GitHub Login Button -->
            <login-with-github />
          </v-card-actions>
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
import axios from 'axios'
export default {
  layout: 'simple',

  head () {
    return { title: this.$t('register') }
  },

  data: () => ({
    valid: false,
    loading: false,
    show: false,
    show1: false,
    form: {
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    },
    // snackbar
    color: '',
    snackbar: false,
    text: '',
    timeout: 6000,
    x: null,
    y: 'top',
    mustVerifyEmail: false,
    nameRules: [
      v => !!v || 'Name is required',
      v => (v && v.length <= 10) || 'Name must be less than 10 characters'
    ],
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid'
    ],
    password: [
      v => !!v || 'password is required',
      v => (v && v.length <= 8) || 'password must be less than 8 characters'
    ],
    min: [
      v => (v && v.length <= 8) || 'password must be less than 8 characters'
    ]
  }),
  computed: {
    passwordConfirmationRule () {
      return () => (String(this.form.password) === String(this.form.password_confirmation)) || 'Password must match'
    }
  },

  methods: {
    async register () {
      await this.$refs.form.validate()
      if (this.valid === true) {
        this.loading = true
        const { data } = await axios.post('/register', {
          name: this.form.name,
          email: this.form.email,
          password: this.form.password,
          password_confirmation: this.form.password_confirmation
        })

        // Must verify email fist.
        if (data && data.status) {
          this.mustVerifyEmail = true
        } else {
          // Log in the user.
          const {
            data: { token }
          } = await axios.post('/login', {
            name: this.form.name,
            email: this.form.email,
            password: this.form.password,
            password_confirmation: this.form.password_confirmation
          })

          // Save the token.
          await this.$store.dispatch('auth/saveToken', { token })

          // Update the user.
          await this.$store.dispatch('auth/updateUser', { user: data })

          await this.$store.dispatch('auth/fetchUser')

          this.showSnack('success', 'You successfull registered')
          this.loading = false
          // Redirect home.
          this.$router.push({ path: '/seamen' })
        }
      } else {
        this.showSnack('error', 'Запольните обязательные поля')
      }
    },
    showSnack (type, text) {
      this.text = text
      this.color = type
      this.snackbar = true
    }

  }
}
</script>
