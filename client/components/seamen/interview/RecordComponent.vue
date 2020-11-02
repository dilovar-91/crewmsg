<template>
  <div class="vld-parent">
    <div v-if="!isStarted">
      <div class="alert alert-info d-flex align-items-center mb-2" role="alert">
        <div class="flex-00-auto">
          <i class="fa fa-fw fa-info-circle"></i>
        </div>
        <div class="flex-fill">
          <p
            class="mb-0 ml-2"
          >Тшательно подготовтесь, а затем нажмите кнопку записи. Появляеться окно доступа вебкамера, разрешите доступ на запись. Внимание: запись начинается автоматически.</p>
        </div>
      </div>
      <div class="round-button ml-auto mr-auto">
        <div class="round-button-circle">
          <i class="si si-video" aria-hidden="true"></i>
          <span class="round-button" @click="isStarted=true">Start Record</span>
        </div>
      </div>
    </div>
    <RecordAnswer
      v-if="total && isStarted"
      :currentQuestion="questions[index]"
      :next="next"
      :increment="increment"
      :total="total"
      :user_id="15"
      :invite_id="invite_id"
      :title="title"
      :start="true"
    />
  </div>
</template>

<script>
import RecordAnswer from "./RecordAnswer.vue";
import axios from "axios";
export default {
  props: {
    title: {
      type: String,
      required: false,
      default: "test",
    },
    user_id: {
      type: Number,
      required: false,
      default: 15,
    },
    invite_id: {
      type: Number,
      required: false,
      default: 17,
    },
  },
  components: {
    RecordAnswer,
  },
  data() {
    return {
      total: 5,
      index: 0,
      isStarted: false,

      isFinished: false,
      isRecorded: false,
    };
  },

  async fetch({ store, query }) {
    await store.dispatch("interview/fetchWQuestions", { id: query.id });
    await store.dispatch("interview/fetchInterview", { id: query.id });
  },
  computed: {
    questions() {
      return this.$store.state.interview.questions;
    },
    interview() {
      return this.$store.state.interview.interview;
    },
  },

  methods: {
    next() {
      this.index++;
    },
    increment(isCorrect) {
      if (isCorrect) {
        this.numCorrect++;
      }
      this.numAnswered++;
    },
  },
};
</script>
<style lang="scss" scoped>
/* change player background color */
#myVideo {
  background-color: #95ddf5;
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
  background: #4679bd;
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