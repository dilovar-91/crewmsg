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
          <v-simple-table fixed-header class="elevation-1 mb-5">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">№</th>
                  <th class="text-left">Interview</th>
                  <th class="text-left">Detail view</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, i) in desserts" :key="item.name">
                  <td>{{ (i+1) }}</td>
                  <td>{{ item.name }}</td>
                  <td>
                    <v-btn icon color="success">
                      <v-icon>mdi-eye</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
export default {
  layout: "main",
  middleware: "role",
  components: {},
  data: () => ({
    links: [
      {
        text: "Seamen",
        disabled: false,
        href: "/seamen",
      },
      {
        text: "My Interviews",
        disabled: true,
        href: "/interviews",
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