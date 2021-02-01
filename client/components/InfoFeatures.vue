<template>
  <base-info-card :title="$t('features')">
    <nuxt-link class="mb-8 grey--text body-1 d-block text-none" to="/sailors">
      &rsaquo; {{ $t('home_page.for_sailors') }}
    </nuxt-link>
    <nuxt-link
      class="mb-8 grey--text body-1 d-block text-none"
      to="/companies"
    >
      &rsaquo; {{ $t('home_page.for_companies') }}
    </nuxt-link>
    <nuxt-link class="mb-8 grey--text body-1 d-block text-none" to="/login">
      &rsaquo; {{ $t('login') }}
    </nuxt-link>
    <nuxt-link class="mb-8 grey--text body-1 d-block text-none" to="/about">
      &rsaquo; {{ $t('about_us') }}
    </nuxt-link>
  </base-info-card>
</template>

<script>
export default {
  name: 'SectionFeaturesAlt',
  data: () => ({

  })
}
</script>
