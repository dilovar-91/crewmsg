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
              scroll-target="#scrolling-techniques-7"
            >
              <v-toolbar-title>Interviews</v-toolbar-title>

              <v-spacer />
              <v-btn to="/employer/interview/create" outlined color="success">
                <v-icon color="success" left>
                  mdi-plus
                </v-icon>Добавить интнервью
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
                        Интервью
                      </th>
                      <th class="text-left">
                        Вакансия
                      </th>
                      <th class="text-left">
                        Кол-во вопросов
                      </th>
                      <th class="text-left">
                        Добавлён
                      </th>
                      <th class="text-left">
                        Статус
                      </th>
                      <th class="text-left">
                        Действие
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, i) in interviews" :key="item.name">
                      <td>{{ (i+1) }}</td>
                      <td>{{ item.title }}</td>
                      <td>{{ item.vacancy && item.vacancy.title }}</td>

                      <td>{{ item.questions.length }}</td>
                      <td>{{ item.created_at }}</td>
                      <td>
                        <v-chip
                          v-if="item.status === 1"
                          class="ma-1"
                          color="success"
                        >
                          Active
                        </v-chip>
                        <v-chip
                          v-else
                          class="ma-1" color="error"
                        >
                          Inactive
                        </v-chip>
                      </td>
                      <td>
                        <v-btn icon color="success" :to="'/employer/interview/edit/'+item.id">
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
        text: 'Interviews',
        disabled: true,
        href: '/employer/interviews'
      }
    ]
  }),
  computed: {
    user () {
      return this.$store.state.auth.user
    },
    interviews () {
      return this.$store.state.interview.employerInterviews
    }
  },
  async fetch ({ store }) {
    await store.dispatch('interview/fetchEmployerInterviews', { userId: store.state.auth.user.id || null })
  }
}
</script>
