<template>
  <v-theme-provider :dark="dark">
    <div>
      <div class="d-flex justify-center mb-4">
        <v-img
          max-width="128"
          min-height="45"
          position="center"
          width="100%"
          src="/images/logo.png"
        ></v-img>
      </div>

      <base-title
        size="body-1"
        class="d-flex justify-center"
        space="4"
        title="MULTI-PURPOSE THEME"
        weight="regular"
      />

      <base-body>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo pariatur.</base-body>

      <v-btn class="mb-4" color="primary" to="/about">More Info</v-btn>
    </div>
  </v-theme-provider>
</template>

<script>
export default {
  name: "BaseInfo",

  props: {
    title: String,
    dark: Boolean,
  },

  data: () => ({
    business: [
      {
        icon: "mdi-map-marker-outline",
        title: "Address",
        text: "8553 N. Beach St. Ste. 227<br>Fort Worth, Texas 76137",
      },
      {
        icon: "mdi-cellphone",
        title: "Phone",
        text: "01 (800) 433 744<br>01 (800) 433 633",
      },
      {
        icon: "mdi-email",
        title: "Email",
        text: "john@vuetifyjs.com<br>heather@vuetifyjs.com",
      },
    ],
  }),
};
</script>
