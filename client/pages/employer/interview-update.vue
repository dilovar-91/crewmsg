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
            >
              <v-toolbar-title>Добавление интервью</v-toolbar-title>

              <v-spacer />
            </v-app-bar>

            <v-card-text>
              <v-form ref="form" v-model="valid" lazy-validation>
                <v-text-field
                  v-model="form.title"
                  :rules="[v => !!v || 'Please enter title']"
                  label="Title"
                  required
                />
                <v-select
                  v-model="form.vacancy_id"
                  item-text="title"
                  item-value="id"
                  :items="vacancies"
                  :rules="[v => !!v || 'Please select vacancy']"
                  label="Vacancy"
                  required
                />
                <section class="content">
                  <client-only>
                    <quill-editor
                      ref="textEditor"
                      v-model="form.description"
                      class="mt-4 editor"
                      style="min-height:180px; height: 220px"
                      :options="editorOption"
                    />
                  </client-only>
                </section>

                <v-tabs
                  v-model="tab"
                  color="primary"
                  grow
                >
                  <v-tab>
                    Quiestions
                  </v-tab>
                  <v-tab>
                    Quizzes
                  </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tab" class="mt-2">
                  <v-tab-item>
                    <v-card
                      color="basil"
                      flat
                    >
                      <v-card-text>
                        <v-data-table
                          :headers="question_headers"
                          :items="questions"
                          class="elevation-1"
                          hide-default-footer
                        >
                          <template v-slot:top>
                            <v-row>
                              <v-col cols="12" class="ml-4">
                                <v-btn color="primary" @click="addQuestion">
                                  <v-icon>mdi-plus</v-icon> Add question
                                </v-btn>
                              </v-col>
                              <v-col v-if="isBrowser" cols="12" class="ml-4">
                                <v-alert
                                  v-if="!$v.questions.required"
                                  color="red"
                                  type="error"
                                >
                                  Questions is required.
                                </v-alert>
                                <v-alert
                                  v-if="!$v.questions.minLength"
                                  color="red"
                                  type="error"
                                >
                                  Questions must be at least {{ $v.questions.$params.minLength.min }} elements.
                                </v-alert>
                              </v-col>
                            </v-row>
                          </template>
                          <template
                            v-slot:body
                          >
                            <tbody>
                              <tr
                                v-for="(question, index) in questions"
                                :key="index"
                              >
                                <td> {{ index+1 }}</td>
                                <td>
                                  <v-textarea v-model="question.text" rows="1" :rules="fieldRules" :label="'Вопрос '+ (index+1) " />
                                </td>
                                <td><v-text-field v-model="question.time" :rules="fieldRules" label="Время ответа" /></td>

                                <td>
                                  <v-btn icon small color="error" @click="deleteQuestion(index)">
                                    <v-icon>mdi-delete</v-icon>
                                  </v-btn>
                                </td>
                              </tr>
                            </tbody>
                          </template>
                        </v-data-table>
                      </v-card-text>
                    </v-card>
                  </v-tab-item>
                  <v-tab-item>
                    <v-card
                      color="basil"
                      flat
                    >
                      <v-card-text>
                        <v-data-table
                          :headers="question_headers"
                          :items="questions"
                          class="elevation-1"
                          hide-default-footer
                        >
                          <template v-slot:top>
                            <v-row>
                              <v-col cols="12" class="ml-4">
                                <v-btn color="success" @click="addQuiz">
                                  <v-icon>mdi-plus</v-icon> Add quiz
                                </v-btn>
                              </v-col>
                            </v-row>
                          </template>
                          <template
                            v-slot:body
                          >
                            <tbody>
                              <tr
                                v-for="(quiz, index) in quizzes"
                                :key="index"
                              >
                                <td> {{ index+1 }}</td>
                                <td>
                                  <v-textarea v-model="quiz.text" rows="1" :rules="fieldRules" :label="'Вопрос '+ (index+1) " />
                                </td>
                                <td><v-text-field v-model="quiz.option1" :rules="fieldRules" label="Вариант №1" /></td>
                                <td><v-text-field v-model="quiz.option2" :rules="fieldRules" label="Вариант №2" /></td>
                                <td><v-text-field v-model="quiz.option3" :rules="fieldRules" label="Вариант №3" /></td>
                                <td><v-text-field v-model="quiz.option4" :rules="fieldRules" label="Вариант №4" /></td>
                                <td><v-text-field v-model="quiz.answer" :rules="fieldRules" label="Ответ" /></td>

                                <td>
                                  <v-btn icon small color="red" @click="deleteQuiz(index)">
                                    <v-icon>mdi-delete</v-icon>
                                  </v-btn>
                                </td>
                              </tr>
                            </tbody>
                          </template>
                        </v-data-table>
                      </v-card-text>
                    </v-card>
                  </v-tab-item>
                </v-tabs-items>

                <v-btn v-if="isBrowser" :disabled="!valid || $v.$invalid" color="success" class="mr-4 mt-2" @click="save">
                  <v-icon>mdi-floppy</v-icon>Сохранить
                </v-btn>

                <v-btn color="error" class="mr-4 mt-2" @click="reset()">
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
import { requiredIf, minLength } from 'vuelidate/lib/validators'
import axios from 'axios'
export default {
  layout: 'employer',
  middleware: 'role',
  components: {

  },
  data: () => ({
    tab: null,
    isBrowser: false,
    links: [
      {
        text: 'Employer',
        disabled: false,
        href: '/employer'
      },
      {
        text: 'Interviews',
        disabled: false,
        href: '/employer/interviews'
      },
      {
        text: 'Create',
        disabled: true,
        href: '/employer/vacancy/create'
      }
    ],
    form: {
      title: '',
      invite_id: '',
      vacancy_id: '',
      description: ''
    },
    questions: [],
    question_headers: [
      { text: '№', value: 'id', sortable: false },
      { text: 'Вопрос', value: 'text', sortable: false },
      { text: 'Время', value: 'time', sortable: false },
      { text: 'Удалить', value: 'remove', sortable: false }
    ],
    quiz_headers: [
      { text: '№', value: 'id', sortable: false },
      { text: 'Вопрос', value: 'question', sortable: false },
      { text: 'Вариант №1', value: 'option1', sortable: false },
      { text: 'Вариант №2', value: 'option2', sortable: false },
      { text: 'Вариант №3', value: 'option3', sortable: false },
      { text: 'Вариант №4', value: 'option4', sortable: false },
      { text: 'Ответ', value: 'time', sortable: false },
      { text: 'Удалить', value: 'remove', sortable: false }
    ],
    question: {
      text: '',
      time: 240,
      pripare_time: ''
    },
    quizzes: [],
    quiz: {
      text: '',
      option1: '',
      option2: '',
      option3: '',
      option4: '',
      correct_answer: ''
    },
    valid: true,
    fieldRules: [
      v => !!v || 'Field is required'
    ],
    content: '<p>Описание вакансии</p>',
    editorOption: {
      placeholder: 'Описание вакансии',
      theme: 'snow'
    }
  }),
  mounted () {
    this.isBrowser = process.browser
  },
  validations: {
    questions: {
      minLength: minLength(3),
      required: requiredIf(function () {
        return this.question
      })
    }
  },

  computed: {
    user () {
      return this.$store.state.auth.user
    },
    vacancies () {
      return this.$store.state.vacancy.vacancies
    }

  },
  async fetch ({ store, params: { id }, error }) {
    await store.dispatch('vacancy/fetchUserVacancies', { userId: store.state.auth.user.id || null })
    axios.get(`/employer/interview/${id}`).then(({ data }) => {
      if (Object.keys(data).length) {
        this.questions = data.questions
        this.quizzes = data.quizzes
        this.form = { id: data.vacancy_id, title: data.title, invite_id: data.invite_id }
        this.description = data.description
      } else { this.$nuxt.error({ statusCode: 404 }) }
    }).catch((err) => {
      error({ statusCode: 404, message: err.message })
    })
  },

  methods: {
    reset () {
      this.$v.$reset()
      this.$refs.form.reset()
    },
    addQuestion () {
      this.questions.push(Object.assign({}, this.question))
    },
    addQuiz () {
      this.quizzes.push(Object.assign({}, this.quiz))
    },
    deleteQuestion (index) {
      this.questions.splice(index, 1)
    },
    deleteQuiz (index) {
      this.quizzes.splice(index, 1)
    },
    save () {
      if (this.$refs.form.validate()) {
        this.form.invite_id = (this.user.id || null)
        this.form.questions = this.questions
        this.form.quizzes = this.quizzes
        this.$store.dispatch('interview/create', {
          item: this.form
        }).then((res) => {
          this.$swal({
            position: 'top-end',
            icon: 'success',
            toast: true,
            title: 'Интервью добавлён',
            showConfirmButton: false,
            timer: 1000
          })
          this.$router.push('/employer/interviews')
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
