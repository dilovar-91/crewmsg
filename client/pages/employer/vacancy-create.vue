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
    <v-container>
      <v-row align="start" class="d-flex" no-gutters>
        <v-col class="mt-5" cols="12">
          <v-card class="mx-auto">
            <v-app-bar
              class="grey lighten-5"
              elevate-on-scroll
            >
              <v-toolbar-title>Добавление вакансии</v-toolbar-title>

              <v-spacer />
            </v-app-bar>

            <v-card-text>
              <v-form ref="form" v-model="valid" lazy-validation>
                <v-text-field v-model="form.title" :rules="fieldRules" label="Title" required />
                <dropzone id="foo" ref="el" :destroy-dropzone="true" :options="dropzoneOptions" @vdropzone-removed-file="fileRemoved" @vdropzone-success="fileAdded" />
                <v-col cols="12">
                  <header>Опции</header>
                </v-col>
                <v-row>
                  <v-col class="mb-0" cols="2" md="6" sm="6" xs="6">
                    <v-switch v-model="form.videoInterview" class="mx-2" label="Видеоинтервью" />
                  </v-col>
                  <v-col class="mb-0" cols="2" md="6" sm="6" xs="6">
                    <v-switch v-model="form.test" class="mx-2" label="Тестирование" />
                  </v-col>
                </v-row>
                <section class="content">
                  <client-only>
                    <quill-editor
                      ref="textEditor"
                      v-model="form.description"
                      :options="editorOption"
                      class="mt-4 editor"
                      style="min-height:200px; height: 300px"
                    />
                  </client-only>
                </section>

                <v-btn :disabled="!valid" class="mr-4 mt-2" color="success" @click="save()">
                  <v-icon>mdi-floppy</v-icon>
                  Сохранить
                </v-btn>

                <v-btn class="mr-4 mt-2" color="error" @click="reset()">
                  Сбросить
                </v-btn>
              </v-form>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import Dropzone from 'nuxt-dropzone'
import 'nuxt-dropzone/dropzone.css'

export default {
  layout: 'employer',
  middleware: 'role',
  components: {
    Dropzone
  },
  data: () => ({
    links: [
      {
        text: 'Employer',
        disabled: false,
        href: '/employer'
      },
      {
        text: 'Отклики',
        disabled: true,
        href: '/feedback'
      },
      {
        text: 'Create',
        disabled: true,
        href: '/employer/vacancy/create'
      }
    ],
    valid: true,
    fieldRules: [
      v => !!v || 'Field is required',
      v => (v && v.length >= 3) || 'Field must be more than 3 characters'
    ],

    dropzoneOptions: {
      url: process.env.apiUrl + '/vacancy/uploadimage',
      maxFilesize: 2, // MB
      maxFiles: 1,
      thumbnailWidth: 150, // px
      thumbnailHeight: 150,
      addRemoveLinks: true,
      dictDefaultMessage:
          "<i   class='v-icon notranslate mdi mdi-camera-enhance  text-h3'  ></i><br>Загрузка изображение",
      headers: {}
    },
    form: {
      title: null,
      pic: null,
      user_id: null,
      description: '<p>Описание вакансии</p>',
      videoInterview: false,
      test: false
    },
    editorOption: {
      placeholder: 'Описание вакансии',
      theme: 'snow'
    }
  }),

  computed: {
    user () {
      return this.$store.state.auth.user
    }
  },

  methods: {
    validate () {
      this.$refs.form.validate()
    },
    reset () {
      this.$refs.form.reset()
      this.form.title = null
      this.form.pic = null
                   this.form.user_id = null
      this.form.descriotion = '<p>Описание вакансии</p>'
      this.form.videoInterview = false
      this.form.test = false
      this.$refs.myVueDropzone.removeAllFiles()
    },
    resetValidation () {
      this.$refs.form.resetValidation()
    },
    fileAdded (file, response) {
      this.form.pic = response.imageName
    },
    fileRemoved () {
      this.form.pic = null
    },

    save () {
      if (this.$refs.form.validate()) {
        this.form.user_id = (this.user.id || null)
        this.$store.dispatch('vacancy/create', {
          item: this.form
        }).then((res) => {
          this.$swal({
            position: 'top-end',
            icon: 'success',
            toast: true,
            title: 'Вакансия добавлён',
            showConfirmButton: false,
            timer: 1000
          })
          this.$router.push('/employer/vacancies')
        }).catch((error) => {
          this.$swal({
            position: 'top-end',
            icon: 'error',
            toast: true,
            title: 'Заполните обязательные поля' + error,
            showConfirmButton: false,
            timer: 2500
          })
        })
      } else {
        this.$swal({
          position: 'top-end',
          icon: 'error',
          toast: true,
          title: 'Заполните обязательные поля',
          showConfirmButton: false,
          timer: 2500
        })
      }
    }
  }
}
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
