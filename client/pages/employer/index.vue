<template>
  <div>
    <v-row no-gutters align="start" class="d-flex">
      <v-col cols="12" class="grey lighten-5">
        <v-breadcrumbs :items="links">
          <template v-slot:divider>
            <v-icon>mdi-chevron-right</v-icon>
          </template>
        </v-breadcrumbs>
      </v-col>

      <v-col cols="12">
        <v-img src="https://cdn.vuetifyjs.com/images/parallax/material.jpg" height="220px">
          <v-row align="center" justify="center" class="lightbox white--text pa-2">
            <v-col align="center">
              <v-avatar size="80">
                <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
              </v-avatar>
              <div class="subheading mt-2">Jonathan Lee</div>
              <div class="body-1">heyfromjonathan@gmail.com</div>

              <div class="text-center mt-2 mb-5">
                <v-btn to="/employer/vacancy/create" class="ma-2" tile color="indigo" dark>
                  <v-icon left>mdi-plus</v-icon>Опубликовать вакансию
                </v-btn>
                <v-btn to="/employer/interview/create" class="ma-2" tile color="indigo" dark>
                  <v-icon left>mdi-plus</v-icon>Добавить интервью
                </v-btn>
                <v-btn to="/employer/invite" class="ma-2" tile color="indigo" dark>
                  <v-icon left>mdi-plus</v-icon>Приглашение
                </v-btn>
              </div>
            </v-col>
          </v-row>
        </v-img>
      </v-col>
    </v-row>
    <v-container class="pa-4 text-center">
      <v-row class="fill-height" align="center" justify="center">
        <template v-for="(item, i) in items">
          <v-col :key="i" cols="12" md="3">
            <v-hover v-slot:default="{ hover }">
              <v-card :elevation="hover ? 12 : 2" :class="{ 'on-hover': hover }">
                <div height="225px" class="bg-blue">
                  <v-card-title class="title white--text">
                    <v-row class="fill-height flex-column pl-2" justify="space-between">
                      <p class="mt-4 subheading text-left">{{ item.title }}</p>

                      <div>
                        <p class="ma-0 body-1 font-weight-bold text-left text-h4">{{ item.count }}</p>
                      </div>
                    </v-row>
                  </v-card-title>
                </div>
              </v-card>
            </v-hover>
          </v-col>
        </template>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  layout: "employer",
  middleware: "role",
  components: {},
  data: () => ({
    links: [
      {
        text: "Employer",
        disabled: false,
        href: "/employer",
      },
      {
        text: "Profile",
        disabled: true,
        href: "/employer/profile",
      },
    ],
    icons: ["mdi-rewind", "mdi-play", "mdi-fast-forward"],
    items: [
      {
        title: "Вакансии",
        text: "It's New Release Friday",
        count: 800,
        img: "http://lorempixel.com/output/nightlife-q-c-640-480-5.jpg",
      },
      {
        title: "Приглашения",
        text: "Greatest Rock Hits",
        count: 450,
        img:
          "https://images.unsplash.com/photo-1498038432885-c6f3f1b912ee?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80",
      },
      {
        title: "Интервью",
        text: "Ambient Bass",
        count: 300,
        img: "http://lorempixel.com/output/abstract-q-c-640-480-6.jpg",
      },
      {
        title: "Отклики",
        text: "Ambient Bass",
        count: 200,
        img: "http://lorempixel.com/output/abstract-q-c-640-480-6.jpg",
      },
    ],
    transparent: "rgba(255, 255, 255, 0)",
  }),
};
</script>
<style scoped>
.v-card {
  transition: opacity 0.4s ease-in-out;
}

.v-card:not(.on-hover) {
  opacity: 0.6;
}

.show-btns {
  color: rgba(255, 255, 255, 1) !important;
}
.bg-blue {
  background-color: #06bad4;
}
</style>