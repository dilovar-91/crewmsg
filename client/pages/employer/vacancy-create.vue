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
              <v-toolbar-title>Добавление вакансии</v-toolbar-title>

              <v-spacer></v-spacer>
            </v-app-bar>

            <v-card-text>
              <v-form ref="form" v-model="valid" lazy-validation>
                <v-text-field v-model="title" :rules="fieldRules" label="Title" required></v-text-field>

                <dropzone id="foo" ref="el" :options="dropzoneOptions" :destroyDropzone="true"></dropzone>
                <v-col cols="12">
                  <header>Опции</header>
                </v-col>
                <v-row>
                  <v-col cols="2" class="mb-0" md="6" sm="6" xs="6">
                    <v-switch v-model="videointerview" class="mx-2" label="Видеоинтервью"></v-switch>
                  </v-col>
                  <v-col cols="2" class="mb-0" md="6" sm="6" xs="6">
                    <v-switch v-model="test" class="mx-2" label="Тестирование"></v-switch>
                  </v-col>
                </v-row>
                <section class="content">
                  <client-only>
                    <quill-editor
                      class="mt-4 editor"
                      style="min-height:200px; height: 300px"
                      v-model="content"
                      ref="textEditor"
                      :options="editorOption"
                    ></quill-editor>
                  </client-only>
                </section>

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
    valid: true,
    title: "",
    videointerview: true,
    test: true,
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
