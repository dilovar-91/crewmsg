<template>
  <div>
    <v-row align="start" class="d-flex" no-gutters>
      <v-col class="grey lighten-5" cols="12">
        <v-breadcrumbs :items="links">
          <template v-slot:divider>
            <v-icon>mdi-chevron-right</v-icon>
          </template>
        </v-breadcrumbs>
      </v-col>
    </v-row>
    <v-row dense>
      <v-col class="mt-5" cols="12">
        <v-app-bar class="grey lighten-5">
          <v-toolbar-title>Запись интервью по  {{ item.title }}</v-toolbar-title>

          <v-spacer />
        </v-app-bar>
      </v-col>
    </v-row>
    <v-container>
      <RecordComponent :questions="item.questions" :title="item.title" :user-id="1" :invite-id="item.invite_id" />
    </v-container>
  </div>
</template>
<script>
import axios from 'axios'
import RecordComponent from '@/components/RecordComponent'
export default {
  layout: 'seamen',
  components: {
    RecordComponent
  },
  data () {
    return {
      links: [
        {
          text: 'Sailor',
          disabled: false,
          href: '/seamen'
        },
        {
          text: 'Recording interview',
          disabled: true,
          href: '/information'
        }
      ]

    }
  },
  computed: {
    item () {
      return this.$store.state.interview.interview
    }
  },
  // async asyncData ({ params }) {
  //  const { data } = await axios.get('/interview/1')
  //  return { item: data }
  // },
  async fetch ({ store, params: { id } }) {
    await store.dispatch('interview/fetchInterview', { id })
  }
}
</script>
