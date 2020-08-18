<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="8" md="4">
      <v-card class="elevation-12">
        <v-toolbar color="primary" dark flat>
          <v-toolbar-title v-if="mustVerifyEmail">
            {{$t('register')}}
            <div class="alert alert-success" role="alert">{{ $t('verify_email_address') }}</div>
          </v-toolbar-title>
          <v-toolbar-title v-else>{{$t('register')}}</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        <v-form @submit.prevent="register" v-model="valid" ref="form" id="register-form">
          <v-card-text>
            <v-text-field
              v-model="form.name"
              :label="$t('name')"
              name="name"
              prepend-icon="mdi-account"
              :rules="nameRules"
              type="text"
              required
            ></v-text-field>
            <v-text-field
              v-model="form.email"
              :label="$t('email')"
              :rules="emailRules"
              name="email"
              prepend-icon="mdi-email"
              type="email"
              required
            ></v-text-field>

            <v-text-field
              id="password"
              ref="password"
              :label="$t('password')"
              v-model="form.password"
              name="password"
              prepend-icon="mdi-lock"
              type="password"
              required
            ></v-text-field>
            <v-text-field
              id="confirm_password"
              :label="$t('confirm_password')"
              v-model="form.password_confirmation"
              name="confirm_password"
              prepend-icon="mdi-lock"
              type="password"
              required
            ></v-text-field>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" form="register-form" @click="register()">{{ $t('register') }}</v-btn>
            <!-- GitHub Login Button -->
            <login-with-github />
          </v-card-actions>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import axios from "axios";
export default {
  layout: "login",
  head() {
    return { title: this.$t("register") };
  },

  data: () => ({
    valid: true,
    form: {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    },
    mustVerifyEmail: false,
    nameRules: [
      (v) => !!v || "Name is required",
      (v) => (v && v.length <= 10) || "Name must be less than 10 characters",
    ],
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
  }),

  methods: {
    async register() {
      // Register the user.
      console.log(this.form);
      const { data } = await axios.post("/register", {
        name: this.form.name,
        email: this.form.email,
        password: this.form.password,
        password_confirmation: this.form.password_confirmation,
      });

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true;
      } else {
        // Log in the user.
        const {
          data: { token },
        } = await axios.post("/login", {
          name: this.form.name,
          email: this.form.email,
          password: this.form.password,
          password_confirmation: this.form.password_confirmation,
        });

        // Save the token.
        this.$store.dispatch("auth/saveToken", { token });

        // Update the user.
        await this.$store.dispatch("auth/updateUser", { user: data });

        // Redirect home.
        this.$router.push({ name: "home" });
      }
    },
  },
};
</script>
