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
    </v-row>
    <v-row dense>
      <v-col cols="12" class="mt-5">
        <v-app-bar class="grey lighten-5" elevate-on-scroll scroll-target="#scrolling-techniques-7">
          <v-toolbar-title>Online database</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-app-bar>
      </v-col>
    </v-row>
    <v-container>
      <v-row dense>
        <v-col cols="12" md="4" sm="12">
          <v-card color="#385F73" dark>
            <v-card-title class="headline">Unlimited music now</v-card-title>

            <v-card-subtitle>Listen to your favorite artists and albums whenever and wherever, online and offline.</v-card-subtitle>

            <v-card-actions>
              <v-btn text>Detail</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col cols="12" md="4" sm="12">
          <v-card color="#385F73" dark>
            <v-card-title class="headline">Unlimited music now</v-card-title>

            <v-card-subtitle>Listen to your favorite artists and albums whenever and wherever, online and offline.</v-card-subtitle>

            <v-card-actions>
              <v-btn text>Detail</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col cols="12" xl="4" md="4" sm="12">
          <v-card color="#385F73" dark>
            <v-card-title class="headline">Unlimited music now</v-card-title>

            <v-card-subtitle>Listen to your favorite artists and albums whenever and wherever, online and offline.</v-card-subtitle>

            <v-card-actions>
              <v-btn text>Detail</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
export default {
  layout: "seamen",
  data: () => ({
    links: [
      {
        text: "Seamen",
        disabled: false,
        href: "/seamen",
      },
      {
        text: "Information",
        disabled: true,
        href: "/information",
      },
    ],
  }),
};
</script>