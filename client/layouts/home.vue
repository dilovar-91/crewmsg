<template>
  <v-app>
    <v-main>
      <home-app-bar />
      <v-fade-transition mode="out-in">
        <nuxt />
      </v-fade-transition>
    </v-main>

    <home-footer />
  </v-app>
</template>

<script>
export default {
  name: 'HomeLayout',
  components: {
    HomeAppBar: () => import('@/components/AppBar'),
    HomeFooter: () => import('@/components/Footer')
    // HomeSettings: () => import('@/components/Settings'),
    // HomeSystemBar: () => import('@/components/SystemBar')
  }
}
</script>
