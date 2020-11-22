<template>
  <div class="vld-parent">
    <div v-if="!isStarted">
      <div class="alert alert-info d-flex align-items-center mb-2" role="alert">
        <div class="flex-00-auto">
          <i class="fa fa-fw fa-info-circle" />
        </div>
        <div class="flex-fill">
          <p class="mb-0 ml-2">
            Тшательно подготовтесь, а затем нажмите кнопку записи. Появляеться окно доступа вебкамера, разрешите доступ
            на запись. Внимание: запись начинается автоматически.
          </p>
        </div>
      </div>
      <div class="round-button ml-auto mr-auto">
        <div class="round-button-circle">
          <i aria-hidden="true" class="si si-video" />
          <span class="round-button" @click="isStarted=true">Start Record</span>
        </div>
      </div>
    </div>
    <client-only>
      <RecordAnswer
        v-if="total && isStarted"
        :current-question="questions[index]"
        :increment="increment"
        :invite-id="inviteId"
        :next="next"
        :start="true"
        :title="title"
        :total="total"
        :total-time="totalTime()"
        :user-id="userId"
      />
    </client-only>
  </div>
</template>

<script>
import RecordAnswer from '@/components/RecordAnswer.vue'

export default {
  components: {
    RecordAnswer
  },
  props: {
    questions: {
      type: Array,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    userId: {
      type: Number,
      required: true
    },
    inviteId: {
      type: Number,
      required: true
    }

  },
  data () {
    return {
      e1: 1,
      steps: 2,
      total: this.questions.length,
      index: 0,
      isStarted: false
    }
  },

  methods: {
    next () {
      this.index++
    },
    increment (isCorrect) {
      if (isCorrect) {
        this.numCorrect++
      }
      this.numAnswered++
    },
    totalTime () {
      const total = this.questions.reduce(function (accumulator, question) {
        return accumulator + question.time
      }, 0)
      console.log(total)
      return total
    }
  }

}
</script>
<style lang="scss" scoped>
/* change player background color */
#myVideo {
  background-color: #95DDF5;
}

@media only screen and (max-width: 600px) {
  .round-button {
    width: 45%;

  }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {

  .round-button {
    width: 35%;

  }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  .round-button {
    width: 30%;

  }
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
  .round-button {
    width: 28%;

  }
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
  .round-button {
    width: 25%;

  }
}

.round-button-circle {
  width: 100%;
  height: 0;
  padding-bottom: 92%;
  border-radius: 50%;
  border: 10px solid #cfdcec;
  overflow: hidden;
  cursor: pointer;
  background: #1976d2 !important;
  box-shadow: 0 0 3px gray;
}

.round-button-circle:hover {
  background: #30588e;
}

.round-button span {
  display: block;
  float: left;
  width: 100%;
  padding-top: 50%;
  padding-bottom: 50%;
  line-height: 1em;
  margin-top: -0.5em;
  text-align: center;
  color: #e2eaf3;
  font-family: Verdana;
  font-size: 1.2em;
  font-weight: bold;
  text-decoration: none;
}
</style>
