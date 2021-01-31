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
          <v-tab v-if="user" :to="'/'+user.role">
            {{ user.name }}
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
import { mapGetters } from 'vuex'

export default {
  name: 'HomeAppBar',
  components: {
    HomeDrawer: () => import('./Drawer'),
    LocaleDropdown: () => import('~/components/LocaleDropdown')
  },
  data: () => ({
    drawer: null

  }),
  computed: {
    links () {
      return [
        {
          title: this.$t('home'),
          route: '/'
        },
        {
          title: this.$t('for_sailors'),
          route: 'sailors'
        },
        {
          title: this.$t('for_companies'),
          route: 'companies'
        },
        {
          title: this.$t('contact'),
          route: 'contact'
        }
      ]
    },
    ...mapGetters({
      user: 'auth/user'
    })
  }
}
</script>
<style lang="css">
#home-app-bar {
  background-color: #203041 !important;
}
</style>
