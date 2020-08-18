<template>
  <div>
    <v-breadcrumbs :items="links">
      <template v-slot:divider>
        <v-icon>mdi-chevron-right</v-icon>
      </template>
    </v-breadcrumbs>

    <v-container>
      <v-row no-gutters align="start" class="d-flex">
        <v-col cols="12" class="mt-5">
          <v-card class="mx-auto">
            <v-app-bar
              class="grey lighten-5"
              elevate-on-scroll
              scroll-target="#scrolling-techniques-7"
            >
              <v-toolbar-title>Добавление интервью</v-toolbar-title>

              <v-spacer></v-spacer>
            </v-app-bar>

            <v-card-text>
              <v-form ref="form" v-model="valid" lazy-validation>
                <v-select
                  v-model="vacancy"
                  :items="vacancies"
                  :rules="[v => !!v || 'Please select vacancy']"
                  label="Vacancy"
                  required
                ></v-select>
                <section class="content">
                  <client-only>
                    <quill-editor
                      class="mt-4 editor"
                      style="max-height:300px; height: 300"
                      v-model="content"
                      ref="textEditor"
                      :options="editorOption"
                    ></quill-editor>
                  </client-only>
                </section>

                <template v-slot:extension>
                  <v-tabs v-model="model" centered slider-color="yellow">
                    <v-tab v-for="i in 3" :key="i" :href="`#tab-${i}`">Item {{ i }}</v-tab>
                  </v-tabs>
                </template>

                <v-tabs-items v-model="model">
                  <v-tab-item v-for="i in 3" :key="i" :value="`tab-${i}`">
                    <v-card flat>
                      <v-card-text v-text="text"></v-card-text>
                    </v-card>
                  </v-tab-item>
                </v-tabs-items>

                <v-btn :disabled="!valid" color="success" class="mr-4 mt-2" @click="validate">
                  <v-icon>mdi-floppy</v-icon>Сохранить
                </v-btn>

                <v-btn color="error" class="mr-4 mt-2" @click="reset()">Сбросить</v-btn>
              </v-form>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import Dropzone from "nuxt-dropzone";
import "nuxt-dropzone/dropzone.css";

export default {
  layout: "employer",
  middleware: "role",
  components: {
    Dropzone,
  },
  data: () => ({
    links: [
      {
        text: "Employer",
        disabled: false,
        href: "/employer",
      },
      {
        text: "Отклики",
        disabled: true,
        href: "/feedback",
      },
      {
        text: "Create",
        disabled: true,
        href: "/employer/vacancy/create",
      },
    ],
    vacancies: ["Item 1", "Item 2", "Item 3", "Item 4"],
    vacancy: "",
    model: "tab-2",
    text:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
    valid: true,

    fieldRules: [
      (v) => !!v || "Field is required",
      (v) => (v && v.length >= 3) || "Field must be more than 3 characters",
    ],

    dropzoneOptions: {
      url: "/api/vacancy/uploadimage",
      maxFilesize: 2, // MB
      maxFiles: 1,
      thumbnailWidth: 150, // px
      thumbnailHeight: 150,
      addRemoveLinks: true,
      dictDefaultMessage:
        "<i   class='v-icon notranslate mdi mdi-camera-enhance  text-h3'  ></i><br>Загрузка изображение",
      headers: {},
    },

    content: "<p>Описание вакансии</p>",
    editorOption: {
      placeholder: "Описание вакансии",
      theme: "snow",
    },
  }),

  methods: {
    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
  },
};
</script>


<style lang="scss" scoped>
.content {
  margin: 0 auto;
  .editor {
    min-height: 200px;
    max-height: 300px;
    overflow-y: auto;
  }
}
</style>
