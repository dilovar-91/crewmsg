<template>
  <base-info-card title="Features">
    <nuxt-link class="mb-8 grey--text body-1 d-block text-none" to="/sailors">&rsaquo; For Sailors</nuxt-link>
    <nuxt-link
      class="mb-8 grey--text body-1 d-block text-none"
      to="/companies"
    >&rsaquo; For Companies</nuxt-link>
    <nuxt-link class="mb-8 grey--text body-1 d-block text-none" to="/login">&rsaquo; Login</nuxt-link>
    <nuxt-link class="mb-8 grey--text body-1 d-block text-none" to="/about">&rsaquo; About Us</nuxt-link>
  </base-info-card>
</template>

<script>
export default {
  name: "SectionFeaturesAlt",

  data: () => ({
    features: [
      "Zero Installation",
      "Easy Customization",
      "User Friendly Design",
      "24/7 Support Desk",
      "SEO Optimized",
    ],
  }),
};
</script>
