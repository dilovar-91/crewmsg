<template>
  <v-col cols="12" class="mt-5">
    <v-card class="mx-auto">
      <v-list-item class="grey lighten-5">
        <v-list-item-content>
          <v-list-item-title class="headline">1. Personal details</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-card-text>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="3">
              <v-text-field v-model="profile.surname" :rules="fieldRules" label="Surname" required></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field
                v-model="profile.first_name"
                :rules="fieldRules"
                label="First Name"
                required
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field
                v-model="profile.other_name"
                :rules="fieldRules"
                label="Others names"
                required
              ></v-text-field>
            </v-col>

            <v-col cols="12" md="3">
              <v-select
                v-model="profile.sex"
                :items="sex"
                :rules="[v => !!v || 'Item is required']"
                label="Sex"
                required
              ></v-select>
            </v-col>

            <v-col cols="12" md="3">
              <v-text-field
                v-model="profile.birthday"
                :rules="fieldRules"
                label="Date of birth"
                required
              ></v-text-field>
            </v-col>

            <v-col cols="12" md="3">
              <v-select
                v-model="profile.citizenship"
                :items="items"
                :rules="[v => !!v || 'Item is required']"
                label="Citizenship"
                required
              ></v-select>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="profile.place" :rules="fieldRules" label="Place of birth"></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-select
                v-model="profile.marial_status"
                :items="items"
                :rules="[v => !!v || 'Item is required']"
                label="Marital Status"
                required
              ></v-select>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="profile.eye_color" :rules="fieldRules" label="Colour of eyes"></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="profile.hair_color" :rules="fieldRules" label="Colour of hair"></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="profile.height" :rules="fieldRules" label="Height"></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="profile.weight" :rules="fieldRules" label="Weight"></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field
                v-model="profile.boilersuit_size"
                :rules="fieldRules"
                label="Boilersuit size"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="profile.boot_size" :rules="fieldRules" label="Boot size"></v-text-field>
            </v-col>

            <v-col cols="12" md="3">
              <v-select
                v-model="profile.language"
                :items="items"
                :rules="[v => !!v || 'Item is required']"
                label="Language"
                required
              ></v-select>
            </v-col>
            <v-col cols="12" md="3">
              <v-text-field v-model="profile.level" :rules="fieldRules" label="Level"></v-text-field>
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
    profile: {
      surname: "",
      first_name: "",
      other_name: "",
      sex: "",
      birthday: "",
      marial_status: "",
      citizenship: "",
      place: "",
      marial_status: "",
      eye_color: "",
      hair_color: "",
      height: "",
      weight: "",
      boilersuit_size: "",
      boot_size: "",
      language: "",
      level: "",
    },
    name: "",
    fieldRules: [
      (v) => !!v || "Field is required",
      (v) => (v && v.length >= 3) || "Field must be more than 3 characters",
    ],
    email: "",
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
    select: null,
    items: ["Item 1", "Item 2", "Item 3", "Item 4"],
    sex: ["Men", "Women"],
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