<template>
  <div>
    <div class="video-container">
      <video id="myVideo" ref="videoPlayer" class="video-js vjs-default-skin" />
      <div class="overlay-desc">
        <div class="overlay">
          <v-expand-transition>
            <h1 v-show="expand">
              Вопрос № {{ (questionNumber + 1) }}: {{ questions[questionNumber].question }}
            </h1>
          </v-expand-transition>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import videojs from 'video.js'
import 'video.js/dist/video-js.css'
export default {
  name: 'VideoPlayer',
  props: {
    options: {
      type: Object,
      default () {
        return {}
      }
    },
    questions: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      player: null,
      questionNumber: 0,
      expand: true,
      isRecorded: false
    }
  },
  watch: {
    currentTime (time) {
      if (time === 0) {
        this.stopTimer()
        if ((this.questionNumber + 1) < this.questions.length) {
          this.expand = false
        }
      }
    }
  },
  mounted () {
    this.player = videojs(this.$refs.videoPlayer, this.options, function onPlayerReady () {
      console.log('onPlayerReady', this)
    })
    this.player.on('play', function () {
      this.startTimer()
      console.log('start player')
    })
    this.player.on('finish', function () {
      this.stopTimer()
      console.log('stop recording')
    })
  },
  beforeDestroy () {
    if (this.player) {
      this.player.dispose()
    }
  },
  methods: {
    totalTime () {
      const total = this.questions.reduce(function (accumulator, question) {
        return accumulator + question.time
      }, 0)
      console.log(total)
      return total
    },
    startTimer () {
      this.timer = setInterval(() => {
        this.currentTime--
      }, 1000)
    },
    stopTimer () {
      clearTimeout(this.timer)
    }
  }
}
</script>
<style scoped>
#myVideo {
  background-color: #95DDF5;
}
.video-container {
  position: absolute;
}
video {
  height: auto;
  vertical-align: middle;
  width: 100%;
}
.overlay-desc {
  background: rgba(0,0,0,0);
  position: absolute;
  top: 0; right: 0; bottom: 35px; left: 0;
  display: flex;
  align-items: flex-end;
  justify-content: center;
}
h1 {
  color: white;
  font-size: 14px;
  text-align: center;

}

main {
  margin: 0 auto;
  width: 100%;
}
.overlay{
  width:100%;
  background-color: black;
  opacity: 0.6;
}

p {
  color: white;
  font-size:12px;
}
</style>
