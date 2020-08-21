<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" :clipped="$vuetify.breakpoint.lgAndUp" app>
      <v-list dense>
        <template v-for="item in items">
          <v-list-group
            v-if="item.children"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>{{ item.text }}</v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item v-for="(child, i) in item.children" :key="i" link>
              <v-list-item-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>
                  <router-link class="link" :to="'/seamen/'+child.url">{{ child.text }}</router-link>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
          <v-list-item v-else :key="item.text" link>
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                <router-link class="link grey lighten-5" :to="'/seamen/'+item.url">{{ item.text }}</router-link>
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <span class="link grey lighten-5" @click="logout()">{{ $t('logout') }}</span>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" app color="blue darken-3" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
        <span class="hidden-sm-and-down">{{appName}}</span>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>
      <v-btn icon large>
        <v-avatar size="32px" item>
          <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
        </v-avatar>
      </v-btn>
      <v-menu bottom left>
        <template v-slot:activator="{ on, attrs }">
          <v-btn dark v-bind="attrs" v-on="on" outlined>
            {{ locales[locale] }}
            <v-icon>mdi-web</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item v-for="(value, key) in locales" :key="key" @click.prevent="setLocale(key)">
            <v-list-item-title>{{ value }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
    <v-main>
      <nuxt />
    </v-main>
  </v-app>
</template>

<script>
import { mapGetters } from "vuex";
import { loadMessages } from "~/plugins/i18n";
export default {
  props: {
    source: String,
  },
  data: ({ context, app }) => ({
    drawer: null,
    appName: process.env.appName,
    items: [
      { icon: "mdi-home", text: "Главная", url: "test" },

      {
        icon: "mdi-briefcase",
        text: "Вакансии",
        url: "vacancies",
      },
      {
        icon: "mdi-chevron-up",
        "icon-alt": "mdi-chevron-down",
        text: "Интервью",
        url: "interviews",
        model: true,
        children: [
          { icon: "mdi-camera-iris", text: "Мои интервью", url: "interviews" },
          {
            icon: "mdi-account-multiple-plus",
            text: "Приглашение",
            url: "interview/invites",
          },
          {
            icon: "mdi-message-reply",
            text: "Мои ответы",
            url: "interview/feedback",
          },
        ],
      },

      { icon: "mdi-cog", text: "Профиль", url: "profile" },

      { icon: "mdi-help-circle", text: "Справочники", url: "information" },
    ],
  }),

  computed: mapGetters({
    locale: "lang/locale",
    locales: "lang/locales",
    user: "auth/user",
  }),

  methods: {
    setLocale(locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale);

        this.$store.dispatch("lang/setLocale", { locale });
      }
    },
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    },
  },
};
</script>
<style scoped>
.link a:hover {
  text-decoration: none;
}
</style>