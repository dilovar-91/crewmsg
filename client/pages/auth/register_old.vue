<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="8" md="4">
      <v-card>
        <v-toolbar
          color="cyan"
          dark
          flat
        >
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

          <template v-slot:extension>
            <v-tabs
              v-model="tab"
              icons-and-text
              centered
              dark
            >
              <v-tabs-slider color="yellow" />
              <v-tab href="#seamen" class="text-black-50">
                Соискатель
                <v-icon>mdi-account</v-icon>
              </v-tab>
              <v-tab href="#company">
                Компания
                <v-icon>mdi-briefcase</v-icon>
              </v-tab>
            </v-tabs>
          </template>
        </v-toolbar>
        <v-tabs-items v-model="tab">
          <v-tab-item :value="'seamen'">
            <v-card flat>
              <v-form id="register-form" ref="form" v-model="valid" @submit.prevent="register">
                <v-card-text>
                  <v-text-field
                    v-model="form.name"
                    :label="$t('name')"
                    prepend-icon="mdi-account"
                    :rules="nameRules"
                    type="text"
                    required
                  />
                  <v-text-field
                    v-model="form.email"
                    :label="$t('email')"
                    :rules="emailRules"
                    name="email"
                    prepend-icon="mdi-email"
                    type="email"
                    required
                  />

                  <v-text-field
                    id="password"
                    ref="password"
                    v-model="form.password"
                    :label="$t('password')"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    required
                  />
                  <v-text-field
                    id="confirm_password"
                    v-model="form.password_confirmation"
                    :label="$t('confirm_password')"
                    name="confirm_password"
                    prepend-icon="mdi-lock"
                    type="password"
                    required
                  />
                </v-card-text>
                <v-card-actions>
                  <v-spacer />

                  <v-btn color="primary" form="register-form " class="mr-2" @click="register()">
                    {{ $t('register') }}
                  </v-btn>
                  or
                  <v-btn color="secondary" to="/login">
                    {{ $t('login') }}
                  </v-btn>
                  <!-- GitHub Login Button -->
                  <login-with-github />
                </v-card-actions>
              </v-form>
            </v-card>
          </v-tab-item>
          <v-tab-item :value="'company'">
            <v-card flat>
              <v-form id="register-form" ref="form" v-model="valid" @submit.prevent="register">
                <v-card-text>
                  <v-text-field
                    v-model="companyForm.name"
                    :label="$t('name')"
                    name="name"
                    prepend-icon="mdi-account"
                    :rules="nameRules"
                    type="text"
                    required
                  />
                  <v-text-field
                    v-model="companyForm.company"
                    :label="$t('company')"
                    :rules="companyRules"
                    name="company"
                    prepend-icon="mdi-briefcase"
                    type="text"
                    required
                  />
                  <v-text-field
                    v-model="companyForm.email"
                    :label="$t('email')"
                    :rules="emailRules"
                    name="email"
                    prepend-icon="mdi-email"
                    type="email"
                    required
                  />

                  <v-text-field
                    id="password"
                    ref="password"
                    v-model="companyForm.password"
                    :label="$t('password')"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    required
                  />
                  <v-text-field
                    id="confirm_password"
                    v-model="companyForm.password_confirmation"
                    :label="$t('confirm_password')"
                    name="confirm_password"
                    prepend-icon="mdi-lock"
                    type="password"
                    required
                  />
                </v-card-text>
                <v-card-actions>
                  <v-spacer />

                  <v-btn color="primary" form="register-form " class="mr-2" @click="register()">
                    {{ $t('register') }}
                  </v-btn>
                  or
                  <v-btn color="secondary" to="/login">
                    {{ $t('login') }}
                  </v-btn>
                  <!-- GitHub Login Button -->
                  <login-with-github />
                </v-card-actions>
              </v-form>
            </v-card>
          </v-tab-item>
        </v-tabs-items>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import axios from 'axios'
export default {
  layout: 'simple',
  middleware: 'guest',
  head () {
    return { title: this.$t('register') }
  },

  data: () => ({
    valid: true,
    tab: null,
    form: {
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    },
    companyForm: {
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    },
    mustVerifyEmail: false,
    nameRules: [
      v => !!v || 'Name is required',
      v => (v && v.length <= 10) || 'Name must be less than 10 characters'
    ],
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid'
    ],
    companyRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid'
    ]
  }),
  watch: {
    form () {
          this.companyForm.name = ''
          this.companyForm.email = ''
          this.companyForm.password = ''
          this.companyForm.password_confirmation = ''
      },
    companyForm () {
        this.form.name = ''
        this.form.email = ''
        this.form.password = ''
        this.form.password_confirmation = ''
      }
    },

  methods: {
    async register () {
      // Register the user.
      console.log(this.form)

      if (this.tab === 'seamen') {
        var data = {
          name: this.form.name,
          email: this.form.email,
          password: this.form.password,
          password_confirmation: this.form.password_confirmation
        }
      } else if (this.tab === 'company') {
        var data = {
          name: this.companyForm.name,
          company: this.companyForm.companyform,
          email: this.companyForm.email,
          password: this.companyForm.password,
          password_confirmation: this.companyForm.password_confirmation
        }
      }

      const { res } = await axios.post('/register', data)

      // Must verify email fist.
      if (res.status) {
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
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        if (this.tab === 'seamen') {
          this.$router.push('/seamen')
        } else {
          this.$router.push('/employer')
        }
      }
    }
  }
}
</script>
