<template>
  <div class="row mb-2">
    <div class="col-sm-12" v-show="!isFinished">
      <div class="block-header">
        <h3 class="block-title">
          Recording interview:
          <span class="text-primary">{{title}}</span>
        </h3>
      </div>
      <div class="block-content">
        <div class="col-md-12 justify-content-center">
          <div class="alert alert-info d-flex align-items-center" role="alert">
            <div class="flex-00-auto">
              <i class="fa fa-fw fa-info-circle"></i>
            </div>
            <div class="flex-fill">
              <p
                class="mb-0 ml-2"
              >In this page can record answer for questions. Record video in a light position and click "Next question". If you not ready for answering any question you can skip by clicking "Skip" button.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div v-show="!isFinished" class="block block-rounded block-themed">
        <div class="block-header bg-modern-light">
          <h3 class="block-title">Вопрос</h3>
        </div>
        <div class="block-content">
          <p class="font-weight-bold">{{ currentQuestion.question }}</p>

          <button
            :disabled="!isRecorded"
            class="btn btn-primary"
            @click="recordSend"
          >Следующий вопрос</button>
          <button class="btn btn-primary" @click="nextStep()">Пропустить</button>
        </div>
      </div>
      <div v-show="isFinished" class="justify-content-center">
        <div class="alert alert-primary alert-dismissable" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h3 class="alert-heading font-w300 my-2">Thank you!</h3>
          <p class="mb-0">
            You result of interview saved.
            <a class="alert-link" href="/seamen/interviews">Go to main</a>!
          </p>
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <video id="myVideo" class="video-js vjs-default-skin" playsinline></video>
    </div>
  </div>
</template>

<script>
import _ from "lodash";

export default {
  props: {
    currentQuestion: Object,
    next: Function,
    increment: Function,
    total: Number,
    title: String,
    start: Boolean,
    user_id: {
      type: Number,
      required: true,
    },
    invite_id: {
      type: Number,
      required: true,
    },
  },
  data: function () {
    return {
      selectedIndex: null,
      correctIndex: null,
      shuffledAnswers: [],
      answered: false,
      isFinished: false,
      isRecorded: false,
      questionNumber: 0,

      fullPage: true,
      color: "#5c80d1",
      player: "",
      save: false,
      comment: "",
      options: {
        controls: true,
        autoplay: false,
        muted: false,
        fluid: true,
        loop: false,
        width: 320,
        height: 240,
        controlBar: {
          volumePanel: false,
          fullscreenToggle: false,
          pip: false,
        },
        plugins: {
          // configure videojs-record plugin
          record: {
            audio: true,
            video: true,
            debug: true,
            maxLength: this.currentQuestion.time,
          },
        },
      },
    };
  },

  mounted() {
    /* eslint-disable no-console */
    this.player = videojs("#myVideo", this.options, () => {
      // print version information at startup
      var msg =
        "Using video.js " +
        videojs.VERSION +
        " with videojs-record " +
        videojs.getPluginVersion("record") +
        " and recordrtc " +
        RecordRTC.version;
      videojs.log(msg);
    });

    // device is ready
    this.player.on("deviceReady", () => {
      console.log("device is ready!");
      this.player.record().start();
    });

    // user clicked the record button and started recording
    this.player.on("startRecord", () => {
      //this.player.record().getDevice();
      console.log("started recording!");
    });

    // user completed recording and stream is available
    this.player.on("finishRecord", () => {
      // the blob object contains the recorded data that
      // can be downloaded by the user, stored on server etc.
      //this.player.record().diable();
      this.player.recordToggle.disable();
      this.isRecorded = true;
      console.log("finished recording: ", this.player.recordedData);
    });

    // error handling
    this.player.on("error", (element, error) => {
      console.warn(error);
    });

    this.player.on("deviceError", () => {
      console.error("device error:", this.player.deviceErrorCode);
    });
    if (this.start === true) {
      this.player.reset();
      this.player.record().getDevice();
    }
  },
  methods: {
    recordSend() {
      let loader = this.$loading.show({
        // Optional parameters
        container: null,
        canCancel: false,
        onCancel: this.onCancel,
        color: this.color,
      });
      let formData = new FormData();
      let blobSend = this.player.recordedData;
      console.log(blobSend);
      formData.append("blob", blobSend);
      formData.append("invite_id", this.invite_id);
      formData.append("question_id", this.currentQuestion.id);
      formData.append("user_id", this.user_id);
      formData.append("comment", this.comment);

      axios
        .post("/seamen/interview/videosend", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          this.increment(true);
          this.questionNumber++;
          if (this.questionNumber < this.total) {
            this.next();
            this.player.reset();
            this.player.recordToggle.enable();
            this.player.record().getDevice();
            //this.player.record().start()
            this.isRecorded = false;
          } else {
            this.isFinished = true;
            axios
              .post("/api/seamen/interview/invited", {
                invite_id: this.invite_id,
              })
              .then((res) => {
                loader.hide();
                this.$swal(
                  "Спасибо!",
                  "Спасибо Ваш интервью успешно сохранен!",
                  "success"
                );
              })
              .catch((err) => {
                loader.hide();
                this.$swal(
                  "Ошибка",
                  "При сохранении вашего интервью что-то пошло не так" + err,
                  "error"
                );
              });
            if (this.player) {
              this.player.dispose();
            }
          }
          loader.hide();
        })
        .catch((err) => {
          loader.hide();
          console.log(err);
        });
    },
    nextStep() {
      this.next();
      this.player.reset();
      this.player.recordToggle.enable();
      this.player.record().getDevice();
      ///this.player.record().start()
      this.isRecorded = false;
    },
  },
};
</script>

<style scoped>
.list-group {
  margin-bottom: 15px;
}

.list-group-item:hover {
  background: #eee;
  cursor: pointer;
}

.btn {
  margin: 0 5px;
}

.selected {
  background-color: lightblue;
}

.bounce-enter-active {
  animation: bounce-in 0.5s;
}
.bounce-leave-active {
  animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}

#myVideo {
  background-color: #95ddf5;
}
</style>
