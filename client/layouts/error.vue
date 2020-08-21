<template>
  <v-app>
    <v-main>
      <home-app-bar />
      <Section404 :error="error" />
      <Newsletter />
      <InfoAlt />
    </v-main>
  </v-app>
</template>
<script>
export default {
  props: ["error"],
  layout: "home",
  components: {
    HomeAppBar: () => import("@/components/AppBar"),
    Section404: () => import("@/pages/sections/404"),
    Newsletter: () => import("@/pages/sections/Newsletter"),
    InfoAlt: () => import("@/pages/sections/Info"),
  },
};
</script>