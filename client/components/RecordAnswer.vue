<template>
  <v-row>
    <v-col v-show="isFinished" cols="12" sm="12" md="12">
      <v-alert
        transition="scale-transition"
        color="primary"
        dark
        icon="mdi-shield-check"
        border="left"
        prominent
      >
        Thank you! <br>
        Your result of interview saved. <v-btn text to="/seamen/interviews">
          Go to main
        </v-btn>
      </v-alert>
    </v-col>
    <v-col v-show="deviceError" cols="12" sm="12" md="12">
      <v-alert
        transition="scale-transition"
        color="error"
        dark
        icon="mdi-alert-circle-outline"
        border="left"
        prominent
      >
        Ошибка доступа!<br>
        Разрешите доступ к камере и обновите страницу.
      </v-alert>
    </v-col>
    <v-col cols="12" md="6" xl="6" lg="6" sm="12">
      <v-card
        v-show="!isFinished"
        class="mx-auto mt-0"
      >
        <video id="myVideo" class="video-js vjs-default-skin" height="200px" playsinline />

        <v-card-title transition="slide-x-transition" class="py-0">
          <v-row>
            <v-col cols="9">
              <h5 transition="slide-x-reverse-transition">
                Вопрос № {{ (questionNumber + 1) }}: {{ currentQuestion.question }}
              </h5>
            </v-col>
            <v-col cols="3">
              <v-chip
                color="success"
                outlined
              >
                {{ currentTime }} из {{ currentQuestion.time }}
              </v-chip>
            </v-col>
          </v-row>
        </v-card-title>
        <v-card-actions class="pt-0">
          <v-btn :disabled="!isRecorded" class="btn" color="primary" @click="recordSend()">
            {{ ((questionNumber+1) !== total) ? 'Следующий вопрос': 'Сохранить' }}
          </v-btn>

          <v-btn v-show="false" class="btn btn-primary" @click="nextStep()">
            Пропустить
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
    <v-col v-show="!isFinished" cols="12" sm="12" md="6" class="justify-content-center">
      <div class="h1">
        Recording interview: <span class="text-primary">{{ title }}</span>
      </div>
      <p class="text-justify subtitle-1">
        In this page can record answer for questions. Record video in a light position and click "Next question". If you not ready for answering any question you can skip by clicking "Skip" button.
      </p>
    </v-col>
  </v-row>
</template>

<script>
import 'video.js/dist/video-js.css'
import 'videojs-record/dist/css/videojs.record.css'
import axios from 'axios'
import 'webrtc-adapter'

import videojs from 'video.js'
if (process.client) {
  const RecordRTC = require('recordrtc')
  const Record = require('videojs-record/dist/videojs.record.js')
}

export default {
  props: {
    currentQuestion: Object,
    next: Function,
    increment: Function,
    total: Number,
    totalTime: Number,
    title: String,
    start: Boolean,
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
      selectedIndex: null,
      correctIndex: null,
      shuffledAnswers: [],
      deviceError: false,
      answered: false,
      isFinished: false,
      isRecorded: false,
      questionNumber: 0,
      currentTime: this.currentQuestion.time,
      timer: 0,
      fullPage: true,
      color: '#5c80d1',
      player: '',
      save: false,
      comment: '',
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
          deviceButton: false,
          recordIndicator: true,
          cameraButton: false,
          recordToggle: false
        },
        plugins: {
          // configure videojs-record plugin
          record: {
            audio: true,
            video: true,
            debug: true,
            maxLength: this.totalTime
          }
        }
      }

    }
  },
  watch: {
    currentTime (time) {
      if (time === 0) {
        this.stopTimer()
        this.player.record().pause()
        this.isRecorded = true
      }
    }
  },

  mounted () {
    /* eslint-disable no-console */
    this.player = videojs('#myVideo', this.options, () => {
      // print version information at startup
      const msg = 'Using video.js ' + videojs.VERSION +
                    ' with videojs-record ' + videojs.getPluginVersion('record')
      videojs.log(msg)
    })

    // device is ready
    this.player.on('deviceReady', () => {
      console.log('device is ready!')
      this.player.record().start()
    })

    // user clicked the record button and started recording
    this.player.on('startRecord', () => {
      // this.player.record().getDevice();
      this.startTimer()
      console.log('started recording!')
    })
    this.player.on('pauseRecord', function () {
      console.log('pause recording')
    })
    this.player.on('resumeRecord', function () {
      console.log('resume recording')
    })
    // error handling
    this.player.on('error', (element, error) => {
      console.warn(error)
    })

    this.player.on('deviceError', () => {
      console.error('device error:', this.player.deviceErrorCode)
      this.deviceError = true
      this.$swal({
        position: 'top-end',
        icon: 'error',
        toast: true,
        title: 'Ошибка! убедитесь, что вы предоставили доступ к камере',
        showConfirmButton: false,
        timer: 3000
      })
    })
    if (this.start === true) {
      this.player.reset()
      this.player.record().getDevice()
    }
  },
  methods: {

    recordSend () {
      this.increment(true)
      this.questionNumber++
      if (this.questionNumber < this.total) {
        this.next()
        this.player.record().resume()
        this.isRecorded = false
        this.currentTime = this.currentQuestion.time
        this.startTimer()
        // this.player.reset()
        // this.player.recordToggle.enable()
        // this.player.record().getDevice()
        // this.player.record().start()
        // this.isRecorded = false
      } else {
        this.isFinished = true
        const formData = new FormData()
        const blobSend = this.player.recordedData
        console.log(blobSend)
        formData.append('blob', blobSend)
        formData.append('invite_id', this.inviteId)
        formData.append('question_id', this.currentQuestion.id)
        formData.append('user_id', this.userId)
        formData.append('comment', this.comment)
        axios.post('/seamen/interview/videosend', formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
        ).then((res) => {
          // loader.hide()
          this.$swal({
            position: 'top-end',
            icon: 'success',
            toast: true,
            title: 'Спасибо Ваш интервью успешно сохранен',
            showConfirmButton: false,
            timer: 2500
          })
          // eslint-disable-next-line handle-callback-err
        }).catch((err) => {
          this.$swal({
            position: 'top-end',
            icon: 'error',
            toast: true,
            title: 'Ошибка, При сохранении вашего интервью что-то пошло не так',
            showConfirmButton: false,
            timer: 2500
          })
        })
        axios.post('/seamen/interview/invited', { invite_id: this.inviteId })
        if (this.player) {
          this.player.dispose()
        }
      }
    },
    nextStep () {
      this.next()
    },
    startTimer () {
      this.timer = setInterval(() => {
        this.currentTime--
      }, 1000)
    },
    stopTimer () {
      clearTimeout(this.timer)
    }
  },
  beforeRouteLeave (to, from, next) {
    if (this.player) {
      this.player.dispose()
    }
    next()
  }
}
</script>

<style scoped>
.list-group {
  margin-bottom: 15px;
}

.list-group-item:hover {
  background: #EEE;
  cursor: pointer;
}

.btn {
  margin: 0 5px;
}

.selected {
  background-color: lightblue;
}

.bounce-enter-active {
  animation: bounce-in .5s;
}
.bounce-leave-active {
  animation: bounce-in .5s reverse;
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
  background-color: #95DDF5;
}
</style>
