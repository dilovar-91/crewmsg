import Vue from 'vue'
import 'video.js/dist/video-js.css'
import 'videojs-record/dist/css/videojs.record.css'

import 'webrtc-adapter'
import RecordRTC from 'recordrtc'

import videojs from 'video.js'
// eslint-disable-next-line
import Record from 'videojs-record/dist/videojs.record.js'
Vue.component(RecordRTC, videojs, Record)