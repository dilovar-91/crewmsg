<template>
  <v-footer id="home-footer" color="grey darken-4 mt-0" dark min-height="72">
    <v-container>
      <v-row>
        <v-col cols="12" md="6">
          <div class="d-flex flex-wrap justify-md-start justify-center justify-md-none">
            <template v-for="(s, i) in socials">
              <a :key="s" class="white--text pa-1 pa-md-0" :href="s.link" target="_blank" v-text="s.name" />

              <v-responsive
                v-if="i < socials.length - 1"
                :key="`divider-${s.name}`"
                class="mx-4 shrink hidden-sm-and-down"
                max-height="24"
              >
                <v-divider vertical />
              </v-responsive>
            </template>
          </div>
        </v-col>

        <v-col
          class="text-center text-md-right"
          cols="12"
          md="6"
        >
          Copyright &copy; {{ $moment().format("YYYY") }} OneClickMarine.Com, LLC
        </v-col>
      </v-row>
    </v-container>
  </v-footer>
</template>

<script>
export default {
  name: 'HomeFooter',

  data: () => ({
    socials: [
      {
        name: 'Facebook',
        link: 'https://www.facebook.com/oneclickmarine'
      },
      {
        name: 'Instagram',
        link: 'https://www.instagram.com/oneclick_marine/'
      },
      {
        name: 'Telegram',
        link: 'https://t.me/oneclickmarine'
      },
      {
        name: 'LinkedIn',
        link: 'https://www.linkedin.com/company/oneclickmarine/'
      }

    ]

  })
}
</script>

<style lang="sass">
#home-footer a
  text-decoration: none
</style>
