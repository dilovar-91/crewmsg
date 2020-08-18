<template>
  <v-col cols="12" class="mt-5">
    <v-card class="mx-auto">
      <v-app-bar class="grey lighten-5" elevate-on-scroll scroll-target="#scrolling-techniques-7">
        <v-toolbar-title>3. Travel documents</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon @click="dialog = !dialog">
          <v-icon color="success">mdi-plus</v-icon>
        </v-btn>
      </v-app-bar>

      <v-card-text>
        <v-simple-table fixed-header class="elevation-1">
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">№</th>
                <th class="text-left">Type</th>
                <th class="text-left">Document No.</th>
                <th class="text-left">Issued date</th>
                <th class="text-left">Expire date</th>
                <th class="text-left">Issued by</th>
                <th class="text-left">Place of issued</th>
                <th class="text-left">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in desserts" :key="item.name">
                <td>{{ item.name }}</td>
                <td>{{ item.calories }}</td>
                <td>{{ item.calories }}</td>
                <td>{{ item.calories }}</td>
                <td>{{ item.calories }}</td>
                <td>{{ item.calories }}</td>
                <td>{{ item.calories }}</td>
                <td>
                  <v-btn icon color="pink">
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>
    </v-card>
    <v-dialog v-model="dialog" width="800px">
      <v-card>
        <v-card-title class="grey lighten-5">Add document</v-card-title>
        <v-container>
          <v-row class="mx-2">
            <v-col class="align-center justify-space-between" cols="12">
              <v-row align="center" class="mr-0">
                <v-avatar size="40px" class="mx-3">
                  <img src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png" alt />
                </v-avatar>
                <v-text-field placeholder="Name"></v-text-field>
              </v-row>
            </v-col>
            <v-col cols="6">
              <v-text-field prepend-icon="mdi-account-card-details-outline" placeholder="Company"></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field placeholder="Job title"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field prepend-icon="mdi-mail" placeholder="Email"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field type="tel" prepend-icon="mdi-phone" placeholder="(000) 000 - 0000"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field prepend-icon="mdi-text" placeholder="Notes"></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-btn text color="primary">More</v-btn>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="dialog = false">Cancel</v-btn>
          <v-btn text @click="dialog = false">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-col>
</template>

<script>
export default {
  data: () => ({
    valid: true,
    dialog: false,
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
    desserts: [
      {
        name: "Frozen Yogurt",
        calories: 159,
      },
      {
        name: "Ice cream sandwich",
        calories: 237,
      },
      {
        name: "Eclair",
        calories: 262,
      },

      {
        name: "KitKat",
        calories: 518,
      },
    ],
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