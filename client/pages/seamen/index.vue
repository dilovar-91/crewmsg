<template>
  <v-row no-gutters align="start" class="d-flex">
    <v-col cols="12" class="grey lighten-5">
      <v-breadcrumbs :items="links">
        <template v-slot:divider>
          <v-icon>mdi-chevron-right</v-icon>
        </template>
      </v-breadcrumbs>
    </v-col>

    <v-col cols="12">
      <v-img src="https://cdn.vuetifyjs.com/images/parallax/material.jpg" height="200px">
        <v-row align="center" justify="center" class="lightbox white--text pa-2">
          <v-col align="center">
            <v-avatar size="80">
              <img src="/icons/user.png" :alt="user && user.name">
            </v-avatar>
            <div class="subheading mt-2">
              {{ user && user.name }}
            </div>
            <div class="body-1">
              {{ user && user.email }}
            </div>
            <div class="body-1">
              <nuxt-link to="/change-account" class="text-decoration-none ">
                <v-icon large color="success">
                  mdi-ship-wheel
                </v-icon> <span class="text-success"> Сменить тип аккаунта</span>
              </nuxt-link>
            </div>
          </v-col>
        </v-row>
      </v-img>
    </v-col>
    <v-col cols="12">
      <v-card class="mx-auto">
        <v-app-bar class="grey lighten-5">
          <v-toolbar-title>0. Main info</v-toolbar-title>

          <v-spacer />

          <v-tooltip left color="success">
            <template v-slot:activator="{ on, attrs }">
              <v-icon color="error" class="text-h3" v-bind="attrs" left v-on="on">
                mdi-file-pdf
              </v-icon>
            </template>
            <span>Сохранить PDF</span>
          </v-tooltip>
        </v-app-bar>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <v-row>
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="name"
                  disabled
                  :counter="10"
                  :rules="nameRules"
                  label="Ready from"
                  required
                />
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field v-model="email" :rules="emailRules" label="Salary $" required />
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="email"
                  :rules="emailRules"
                  label="Application for position as"
                  required
                />
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="email"
                  :rules="emailRules"
                  label="Other position (If any)"
                  required
                />
              </v-col>
            </v-row>
          </v-form>
        </v-card-text>

        <v-card-actions class="grey lighten-5">
          <v-btn text color="error">
            Edit
          </v-btn>
          <v-btn text color="success">
            Save
          </v-btn>
          <v-spacer />
          <v-btn icon>
            <v-icon x-large color="success">
              mdi-pen
            </v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
    <detail />
    <AddressComponent />
    <TravelDocument />
    <EducationDocument />
    <CourseList />
    <Experience />
  </v-row>
</template>
<script>
import { mapGetters } from 'vuex'
import detail from '~/components/seamen/profile/detail'
import TravelDocument from '~/components/seamen/profile/TravelDocument'
import AddressComponent from '~/components/seamen/profile/AddressComponent'
import EducationDocument from '~/components/seamen/profile/EducationDocument'
import CourseList from '~/components/seamen/profile/CourseList'
import Experience from '~/components/seamen/profile/Experience'
export default {
  head () {
    return { title: this.$t('home') }
  },
  layout: 'seamen',
  middleware: 'role',
  components: {
    detail,
    AddressComponent,
    TravelDocument,
    EducationDocument,
    CourseList,
    Experience
  },
  data: () => ({
    links: [
      {
        text: 'Seamen',
        disabled: false,
        href: '/seamen'
      },
      {
        text: 'Profile',
        disabled: true,
        href: '/seamen/profile'
      }
    ],

    valid: true,
    name: '',
    nameRules: [
      v => !!v || 'Name is required',
      v => (v && v.length <= 10) || 'Name must be less than 10 characters'
    ],
    email: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid'
    ],
    select: null,
    items: ['Item 1', 'Item 2', 'Item 3', 'Item 4'],
    checkbox: false
  }),
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },

  methods: {
    validate () {
      this.$refs.form.validate()
    },
    reset () {
      this.$refs.form.reset()
    },
    resetValidation () {
      this.$refs.form.resetValidation()
    }
  }
}
</script>
