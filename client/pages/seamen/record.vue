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
          <v-toolbar-title>  {{ item.title }}</v-toolbar-title>
          <v-spacer />
        </v-app-bar>
      </v-col>
    </v-row>
    <v-container v-if="item && item.feedback !==null">
      <v-row>
        <v-col cols="12" sm="12" md="7" xl="7">
          <video-player :options="videoOptions" />
        </v-col>
        <v-col cols="12" sm="12" md="5" xl="5">
          <v-list two-line>
            <v-list-item-group
              v-model="selected"
              active-class="pink--text"
              multiple
            >
              <template v-for="(row, index) in item.questions">
                <v-list-item :key="row.id">
                  <template v-slot:default="{ active }">
                    <v-list-item-content>
                      <v-list-item-title v-text="row.question" />

                      <v-list-item-subtitle
                        class="text--primary"
                        v-text="row.question"
                      />

                      <v-list-item-subtitle v-text="row.question" />
                    </v-list-item-content>

                    <v-list-item-action>
                      <v-list-item-action-text v-text="row.time + ' мин' " />

                      <v-icon

                        color="yellow darken-3"
                      >
                        mdi-comment-question-outline
                      </v-icon>
                    </v-list-item-action>
                  </template>
                </v-list-item>

                <v-divider
                  v-if="index < item.questions.length - 1"
                  :key="index"
                />
              </template>
            </v-list-item-group>
          </v-list>
        </v-col>
      </v-row>
    </v-container>
    <v-container v-else>
      <RecordComponent :questions="item.questions" :interview-id="item.id" :title="item.title" :user-id="1" :invite-id="item.invite_id" />
    </v-container>
  </div>
</template>
<script>
import RecordComponent from '~/components/RecordComponent'
import VideoPlayer from '~/components/VideoPlayer.vue'
export default {
  layout: 'seamen',
  components: {
    RecordComponent,
    VideoPlayer
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
    },

          videoOptions () {
            return {
            autoplay: true,
            controls: true,
            sources: [
              {
                src: 'http://crew-nuxt/videos/' + this.item.feedback.video,
                type: 'video/mp4'
              }
            ]
          }
        }

  },
  async fetch ({ store, params: { id } }) {
    await store.dispatch('interview/fetchInterview', { id })
    await store.dispatch('interview/fetchFeedback', { id })
  }
}
</script>
