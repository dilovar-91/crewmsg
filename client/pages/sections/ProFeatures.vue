<template>
  <base-section id="pro-features" :space="32">
    <v-img :src="'/img/logo.svg'" class="mx-auto mb-8" max-width="128" />

    <base-section-heading title="Feature Comparison">
      Get the PRO version of
      <strong>Zero</strong> and level up your theme
      <br>with additional components, pages, and Free updates.
    </base-section-heading>

    <v-container>
      <v-row align="center" justify="center">
        <v-col cols="12" md="7">
          <v-simple-table>
            <thead>
              <tr>
                <th />
                <th class="body-1 font-weight-bold text-center">
                  What's in the Demo?
                </th>
                <th class="body-1 font-weight-bold text-center">
                  What's in the PRO version?
                </th>
              </tr>
            </thead>

            <tbody class="body-1">
              <tr v-for="([name, one, two], i) in features" :key="i">
                <td v-text="name" />

                <td class="text-center font-weight-bold">
                  <template v-if="typeof one === 'boolean'">
                    <v-icon :color="one ? 'success' : 'error'">
                      mdi-{{ one ? 'check' : 'close' }}
                    </v-icon>
                  </template>

                  <template v-else>
                    {{ one }}
                  </template>
                </td>

                <td class="text-center font-weight-bold">
                  <template v-if="typeof two === 'boolean'">
                    <v-icon :color="two ? 'success' : 'error'">
                      mdi-{{ two ? 'check' : 'close' }}
                    </v-icon>
                  </template>

                  <template v-else>
                    {{ two }}
                  </template>
                </td>
              </tr>
            </tbody>
          </v-simple-table>
        </v-col>

        <v-col cols="12" md="5">
          <v-card elevation="16" class="mb-12">
            <v-img
              class="pointer"
              max-width="100%"
              src="/images/videoposter.png"
              @click.stop="dialog = true"
            />

            <v-dialog v-model="dialog" class="mb-0">
              <iframe
                v-if="dialog"
                width="940"
                height="528"
                src="https://www.youtube.com/embed/UOZ2hBWdNr0"
                frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
              />
            </v-dialog>
          </v-card>

          <div class="text-center">
            <base-btn
              :tile="false"
              color="primary"
              href="https://store.vuetifyjs.com/product/zero-theme-pro/?ref=vtyd-pro-page-features"
              rounded
              to="/register"
            >
              {{ $t('home_page.join_us') }}
              <v-icon right>
                mdi-rocket
              </v-icon>
            </base-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </base-section>
</template>

<script>
export default {
  name: 'SectionProChart',

  data: () => ({
    dialog: false,
    features: [
      ['Components', 23, '40+'],
      ['Example Pages', 3, 10],
      ['Bugfixes and Issues', true, true],
      ['Vue CLI Support', true, true],
      ['News, Project, and Pricing Pages', false, true],
      ['6 Months Free Updates', false, true],
      ['Price', 'Free', '$60']
    ]
  })
}
</script>
<style scoped>
.ponter {
  cursor: pointer;
}
</style>
