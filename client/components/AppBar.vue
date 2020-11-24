<template>
  <div>
    <v-app-bar id="home-app-bar" app dark elevation="1" class="appstyle" height="90">
      <nuxt-link to="/">
        <base-img src="/images/logo-white.svg" class="ml-5 mr-2" contain max-width="200" width="100%" />
      </nuxt-link>
      <v-spacer />

      <div>
        <v-tabs class="hidden-sm-and-down mr-1" optional background-color="transparent">
          <v-tab
            v-for="(name, i) in items"
            :key="i"
            :to="{ name }"
            :exact="name === 'Home'"
            :ripple="false"
            active-class="white--text "
            class="font-weight-bold white--text"
            min-width="96"
            text
          >
            {{ name }}
          </v-tab>
        </v-tabs>
      </div>
      <LocaleDropdown />

      <v-app-bar-nav-icon class="hidden-md-and-up" @click="drawer = !drawer" />
    </v-app-bar>

    <home-drawer v-model="drawer" :items="items" />
  </div>
</template>

<script>
export default {
  name: 'HomeAppBar',

  components: {
    HomeDrawer: () => import('./Drawer'),
    LocaleDropdown: () => import('@/components/LocaleDropdown')
  },

  data: () => ({
    drawer: null,
    items: ['Home', 'For sailors', 'For Companies', 'Contact']
  })
}
</script>

<style lang="css">
#home-app-bar {
  /*background-color: rgba(4, 25, 44, 0.76) !important;*/
  background-color: rgb(24 42 62 / 85%) !important;
}
</style>
