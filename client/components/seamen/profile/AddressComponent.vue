<template>
  <v-col cols="12" class="mt-5">
    <v-card class="mx-auto">
      <v-list-item class="grey lighten-5">
        <v-list-item-content>
          <v-list-item-title class="headline">2. Address</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-card-text>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="3">
              <v-text-field v-model="address.country" :rules="fieldRules" label="Country" required></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="address.city" :rules="fieldRules" label="City" required></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field
                v-model="address.postcode"
                :rules="fieldRules"
                label="Post code"
                required
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="address.mobile" :rules="fieldRules" label="Mobile" required></v-text-field>
            </v-col>

            <v-col cols="12" md="3">
              <v-text-field v-model="address.email" :rules="emailRules" label="email" required></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="address.skype" :rules="fieldRules" label="Skype" required></v-text-field>
            </v-col>

            <v-col cols="12" md="3">
              <v-text-field v-model="address.messengers" :rules="fieldRules" label="Messengers"></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="address.next_of_kin" :rules="fieldRules" label="Next of kin"></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field v-model="address.kin_address" :rules="fieldRules" label="Kin address"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field v-model="address.kin_mobile" :rules="fieldRules" label="Kin mobile"></v-text-field>
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>

      <v-card-actions class="grey lighten-5">
        <v-btn text color="error">Edit</v-btn>
        <v-btn text color="success">Save</v-btn>
        <v-spacer></v-spacer>
        <v-btn icon>
          <v-icon x-large color="success">mdi-pen</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-col>
</template>

<script>
export default {
  data: () => ({
    valid: true,
    address: {
      country: "",
      city: "",
      postcode: "",
      mobile: "",
      email: "",
      skype: "",
      messengers: "",
      next_of_kin: "",
      kin_address: "",
      kin_mobile: "123",
    },

    fieldRules: [
      (v) => !!v || "Field is required",
      (v) => (v && v.length >= 3) || "Field must be more than 3 characters",
    ],
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],

    select: null,
    items: ["Item 1", "Item 2", "Item 3", "Item 4"],
    sex: ["Men", "Women"],
    dialog: false,
  }),

  methods: {
    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
  },
};
</script>