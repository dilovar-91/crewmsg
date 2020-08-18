<template>
  <v-row no-gutters align="start" class="d-flex">
    <v-col cols="12" class="grey lighten-5">
      <v-breadcrumbs :items="links">
        <template v-slot:divider>
          <v-icon>mdi-chevron-right</v-icon>
        </template>
      </v-breadcrumbs>
    </v-col>
    <v-col cols="12" class="mt-5">
      <v-card class="mx-auto">
        <v-app-bar class="grey lighten-5" elevate-on-scroll scroll-target="#scrolling-techniques-7">
          <v-toolbar-title>List of completed interviews</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-app-bar>

        <v-card-text>
          <RecordComponent />
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
import RecordComponent from "@/components/seamen/interview/RecordComponent.vue";
export default {
  layout: "main",
  middleware: "role",
  components: { RecordComponent },
  data: () => ({
    links: [
      {
        text: "Seamen",
        disabled: false,
        href: "/seamen",
      },
      {
        text: "My Interviews",
        disabled: false,
        href: "/interviews",
      },
      {
        text: "Record",
        disabled: true,
        href: "",
      },
    ],
    desserts: [
      {
        name: "Frozen Yogurt",
        calories: 159,
      },
      {
        name: "Ice cream sandwich",
        calories: 237,
      },
      {
        name: "Eclair",
        calories: 262,
      },
    ],
  }),
};
</script>