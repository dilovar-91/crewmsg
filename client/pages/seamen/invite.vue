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
        <v-app-bar class="grey lighten-5">
          <v-toolbar-title>6. Specialised experience</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-app-bar>

        <v-card-text>
          <v-simple-table fixed-header class="elevation-1">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">№</th>
                  <th class="text-left">Type</th>
                  <th class="text-left">From</th>
                  <th class="text-left">To</th>
                  <th class="text-left">Comments</th>

                  <th class="text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in desserts" :key="item.name">
                  <td>{{ item.name }}</td>
                  <td>{{ item.calories }}</td>
                  <td>{{ item.calories }}</td>
                  <td>{{ item.calories }}</td>
                  <td>{{ item.calories }}</td>

                  <td>
                    <v-btn icon color="pink">
                      <v-icon>mdi-delete</v-icon>
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
  layout: "seamen",
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
        text: "Interview",
        disabled: false,
        href: "/interview",
      },
      {
        text: "Invites",
        disabled: true,
        href: "/seamen/interview/invites",
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