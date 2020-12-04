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
    <v-container>
      <v-row no-gutters align="start" class="d-flex">
        <v-col cols="12" class="mt-5">
          <v-card class="mx-auto">
            <v-app-bar
              class="grey lighten-5"
              elevate-on-scroll
            >
              <v-toolbar-title>Вакансии</v-toolbar-title>

              <v-spacer />
              <v-btn to="/employer/vacancy/create" outlined color="success">
                <v-icon color="success" left>
                  mdi-plus
                </v-icon>Добавить вакансию
              </v-btn>
            </v-app-bar>

            <v-card-text>
              <v-simple-table fixed-header class="elevation-1 mb-5">
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left">
                        №
                      </th>
                      <th class="text-left">
                        Название
                      </th>
                      <th class="text-left">
                        Добавлён
                      </th>
                      <th class="text-left">
                        Видеоинтервью
                      </th>
                      <th class="text-left">
                        Тесты
                      </th>
                      <th class="text-left">
                        Действие
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, i) in vacancies" :key="i">
                      <td>{{ (i+1) }}</td>
                      <td>{{ item.title }}</td>
                      <td>{{ item.created_at }}</td>
                      <td>
                        <v-chip
                          v-if="item.videoInterview === 1"
                          class="ma-1"
                          color="success"
                        >
                          Да
                        </v-chip>
                        <v-chip
                          v-else
                          class="ma-1" color="error"
                        >
                          Нет
                        </v-chip>
                      </td>
                      <td>
                        <v-chip
                          v-if="item.test === 1"
                          class="ma-1"
                          color="success"
                        >
                          Да
                        </v-chip>
                        <v-chip
                          v-else
                          class="ma-1" color="error"
                        >
                          Нет
                        </v-chip>
                      </td>
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
    </v-container>
  </div>
</template>
<script>
export default {
  layout: 'employer',
  middleware: 'role',
  components: {},
  data: () => ({
    links: [
      {
        text: 'Employer',
        disabled: false,
        href: '/employer'
      },
      {
        text: 'Вакансии',
        disabled: true,
        href: '/vacancies'
      }
    ],
    desserts: [
      {
        name: 'Frozen Yogurt',
        calories: 159
      },
      {
        name: 'Ice cream sandwich',
        calories: 237
      },
      {
        name: 'Eclair',
        calories: 262
      }
    ]
  }),
  computed: {
    user () {
      return this.$store.state.auth.user
    },
    vacancies () {
      return this.$store.state.vacancy.employerVacancies
    }
  },
  async fetch ({ store }) {
    await store.dispatch('vacancy/fetchUserVacancies', { userId: store.state.auth.user.id || null })
  }
}
</script>
