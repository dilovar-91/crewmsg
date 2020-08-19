<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" color="grey" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="10" md="5">
            <v-card
              class="elevation-12"
              dark
              style="background:url(https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg)"
            >
              <v-card-text v-if="error.statusCode === 404" class="headline font-weight-bold">
                <h1
                  v-if="error.statusCode === 404"
                  class="text-center"
                  style="color:#fff;"
                >Page not found</h1>
                <h1 v-else class="text-center" style="color:#fff;">An error occurred</h1>
                <p class="text-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="90"
                    height="90"
                    fill="#fff"
                    viewBox="0 0 48 48"
                  >
                    <path
                      d="M22 30h4v4h-4zm0-16h4v12h-4zm1.99-10C12.94 4 4 12.95 4 24s8.94 20 19.99 20S44 35.05 44 24 35.04 4 23.99 4zM24 40c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"
                    />
                  </svg>
                </p>
                <p style="color:#fff;">OOPS... the page you're looking for isn't here.</p>
              </v-card-text>
              <v-card-text v-else class="headline font-weight-bold">
                <p style="color:#fff;">Server error. Please try again later or click go home button</p>
              </v-card-text>

              <v-card-actions class="text-center">
                <v-btn class="my-2" block to="/" outlined>
                  <v-icon>mdi-home</v-icon>Go Home
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
export default {
  props: ["error"],
};
</script>