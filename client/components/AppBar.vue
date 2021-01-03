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
            v-for="(item, i) in links"
            :key="i"
            :to="item.route"
            :exact="item.route === $nuxt.$route.name"
            :ripple="true"
            active-class="white--text "
            class="font-weight-bold white--text"
            min-width="96"
            text
          >
            {{ item.title }}
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
    LocaleDropdown: () => import('~/components/LocaleDropdown')
  },
  data: vm => ({
    drawer: null,
    links: [
      {
        title: vm.$t('home'),
        route: '/'
      },
      {
        title: vm.$t('for_sailors'),
        route: 'sailors'
      },
      {
        title: vm.$t('for_companies'),
        route: 'companies'
      },
      {
        title: vm.$t('contact'),
        route: 'contact'
      }
    ]
  })
}
</script>
<style lang="css">
#home-app-bar {
  background-color: #203041 !important;
}
</style>
