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
    <v-row dense>
      <v-col cols="12" class="mt-5">
        <v-app-bar class="grey lighten-5">
          <v-toolbar-title>Online database </v-toolbar-title>

          <v-spacer></v-spacer>
        </v-app-bar>
      </v-col>
    </v-row>
    <v-container>
      <v-stepper v-model="e1">
        <v-stepper-header>
          <template v-for="n in steps">
            <v-stepper-step
              :key="`${n}-step`"
              :complete="e1 > n"
              :step="n"
              editable
              >Step {{ n }}</v-stepper-step
            >

            <v-divider v-if="n !== steps" :key="n"></v-divider>
          </template>
        </v-stepper-header>

        <v-stepper-items>
          <v-stepper-content v-for="n in steps" :key="`${n}-content`" :step="n">
            <v-card class="mb-12" color="grey lighten-1" height="300px">
              <video
                id="myVideo"
                class="video-js vjs-default-skin"
                playsinline
              />
            </v-card>

            <v-btn color="primary" @click="nextStep(n)">Continue</v-btn>

            <v-btn text>Cancel</v-btn>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </v-container>
  </div>
</template>
<script>
/* eslint-disable */
import "video.js/dist/video-js.css";
import "videojs-record/dist/css/videojs.record.css";
import videojs from "video.js";

import "webrtc-adapter";
import RecordRTC from "recordrtc";

// the following imports are only needed when you're recording
// audio-only using the videojs-wavesurfer plugin
/*
    import WaveSurfer from 'wavesurfer.js';
    import MicrophonePlugin from 'wavesurfer.js/dist/plugin/wavesurfer.microphone.js';
    WaveSurfer.microphone = MicrophonePlugin;

    // register videojs-wavesurfer plugin
    import videojs_wavesurfer_css from 'videojs-wavesurfer/dist/css/videojs.wavesurfer.css';
    import Wavesurfer from 'videojs-wavesurfer/dist/videojs.wavesurfer.js';
    */

import Record from "videojs-record/dist/videojs.record.js";
export default {
  layout: "seamen",

  data() {
    return {
      links: [
        {
          text: "Seamen",
          disabled: false,
          href: "/seamen",
        },
        {
          text: "Information",
          disabled: true,
          href: "/information",
        },
      ],
      e1: 1,
      steps: 2,
      player: "",
      options: {
        controls: true,
        autoplay: false,
        fluid: false,
        loop: false,
        width: 320,
        height: 240,
        bigPlayButton: false,
        controlBar: {
          volumePanel: false,
        },
        plugins: {
          /*
                        // this section is only needed when recording audio-only
                        wavesurfer: {
                            backend: 'WebAudio',
                            waveColor: '#36393b',
                            progressColor: 'black',
                            debug: true,
                            cursorWidth: 1,
                            displayMilliseconds: true,
                            hideScrollbar: true,
                            plugins: [
                                // enable microphone plugin
                                WaveSurfer.microphone.create({
                                    bufferSize: 4096,
                                    numberOfInputChannels: 1,
                                    numberOfOutputChannels: 1,
                                    constraints: {
                                        video: false,
                                        audio: true
                                    }
                                })
                            ]
                        },
                        */
          // configure videojs-record plugin
          record: {
            audio: false,
            video: true,
            debug: true,
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
    });

    // user clicked the record button and started recording
    this.player.on("startRecord", () => {
      console.log("started recording!");
    });

    // user completed recording and stream is available
    this.player.on("finishRecord", () => {
      // the blob object contains the recorded data that
      // can be downloaded by the user, stored on server etc.
      console.log("finished recording: ", this.player.recordedData);
    });

    // error handling
    this.player.on("error", (element, error) => {
      console.warn(error);
    });

    this.player.on("deviceError", () => {
      console.error("device error:", this.player.deviceErrorCode);
    });
  },
  beforeDestroy() {
    if (this.player) {
      this.player.dispose();
    }
  },
  watch: {
    steps(val) {
      if (this.e1 > val) {
        this.e1 = val;
      }
    },
  },

  methods: {
    nextStep(n) {
      if (n === this.steps) {
        this.e1 = 1;
      } else {
        this.e1 = n + 1;
      }
    },
  },
};
</script>