<template>
  <v-navigation-drawer fixed temporary v-bind="$attrs" v-on="$listeners">
    <v-list>
      <v-list-item
        v-for="item in links"
        :key="item.title"
        :to="{ name:item.route }"
        :exact="item.route === 'Home'"
        color="primary"
      >
        <v-list-item-content>
          <v-list-item-title v-text="item.title" />
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: 'HomeDrawer',

  props: {
    items: {
      type: Array,
      default: () => []
    }
  },
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
    }
  }
}
</script>
