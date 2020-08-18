require('dotenv').config()
const { join } = require('path')
const { copySync, removeSync } = require('fs-extra')
const webpack = require('webpack')

module.exports = {
  //mode: 'universal', // Comment this for SSR
  server: {
    //port: process.env.APP_PORT || 9000, // default: 3000
    //host: '0.0.0.0', // default: localhost
  },
  srcDir: __dirname,

  env: {
    apiUrl: process.env.API_URL || process.env.APP_URL + '/api',
    appName: process.env.APP_NAME || 'CrewMsg',
    appLocale: process.env.APP_LOCALE || 'en',
    githubAuth: !!process.env.GITHUB_CLIENT_ID
  },

  head: {
    title: process.env.APP_NAME,
    titleTemplate: '%s - ' + process.env.APP_NAME,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  loading: { color: '#007bff' },

  router: {
    middleware: ['locale', 'check-auth']
  },

  css: [
    // { src: '~assets/sass/app.scss', lang: 'scss' }
    '~static/css/style.css',
  ],

  plugins: [
    '~components/global',
    '~plugins/i18n',
    '~plugins/vform',
    '~plugins/axios',
    '~plugins/fontawesome',
    '~plugins/nuxt-client-init', // Comment this for SSR
    { src: '~plugins/vuelidate', mode: 'client' },
    { src: "~plugins/vue-quill-editor", ssr: false },

  ],

  modules: [
    '@nuxtjs/router',

  ],


  build: {
    extractCSS: true,
    vendor: ["jquery"],
    plugins: [

      new webpack.ProvidePlugin({
        jQuery: 'jquery',
        $: 'jquery',
        'window.jQuery': 'jquery',
      }),
    ],
  },

  buildModules: [

    // With options
    ['@nuxtjs/vuetify', { /* module options */ }]
  ],

  hooks: {
    generate: {
      done(generator) {
        // Copy dist files to public/_nuxt
        if (generator.nuxt.options.dev === false && generator.nuxt.options.mode === 'spa') {
          const publicDir = join(generator.nuxt.options.rootDir, 'public', '_nuxt')
          removeSync(publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '_nuxt'), publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '200.html'), join(publicDir, 'index.html'))
          removeSync(generator.nuxt.options.generate.dir)
        }
      }
    }
  }
}
