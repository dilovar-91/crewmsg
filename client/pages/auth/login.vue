<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="10" md="5">
      <v-card class="elevation-12">
        <v-toolbar color="primary" dark flat>
          <v-toolbar-title>{{ $t('login')}}</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-form
          @submit.prevent="login"
          @keydown="form.onKeydown($event)"
          v-model="valid"
          id="login-form"
          ref="form"
        >
          <v-card-text>
            <v-text-field
              :label="$t('email')"
              v-model="form.email"
              name="login"
              :rules="emailRules"
              required
              prepend-icon="mdi-account"
              autocomplete="off"
              type="text"
            ></v-text-field>

            <v-text-field
              id="password"
              :label="$t('password')"
              v-model="form.password"
              name="password"
              prepend-icon="mdi-lock"
              type="password"
              required
            ></v-text-field>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <checkbox v-model="remember" name="remember">{{ $t('remember_me') }}</checkbox>

            <router-link
              :to="{ name: 'password.request' }"
              class="small ml-auto my-auto"
            >{{ $t('forgot_password') }}</router-link>
            <v-btn
              :disabled="!valid"
              color="primary"
              :loading="form.busy"
              @click="login()"
              form="login-form"
            >{{$t('login')}}</v-btn>
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
import Form from "vform";

export default {
  layout: "login",
  head() {
    return { title: this.$t("login") };
  },

  data: () => ({
    form: new Form({
      email: "",
      password: "",
    }),
    valid: true,
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
    remember: false,

    //snackbar
    color: "",
    snackbar: false,
    text: "",
    timeout: 6000,
    x: null,
    y: "top",
  }),

  methods: {
    async login() {
      let data;

      // Submit the form.
      try {
        const response = await this.form.post("/login");
        data = response.data;
        this.showSnack("success", "You successfull logined in");
      } catch (e) {
        var error = e.response.data.message;

        if (!error) {
          error = e.response.data.error;
        }

        this.showSnack("error", error);
        return;
      }

      // Save the token.
      this.$store.dispatch("auth/saveToken", {
        token: data.token,
        remember: this.remember,
        role: data.role,
      });

      // Fetch the user.
      await this.$store.dispatch("auth/fetchUser");

      // Redirect home.
      this.$router.push("/" + data.role);
    },

    showSnack(type, text) {
      this.text = text;
      this.color = type;
      this.snackbar = true;
    },
  },
};
</script>
