require('dotenv').config()
const { join } = require('path')
const { copySync, removeSync } = require('fs-extra')

module.exports = {
  mode: 'spa', // Comment this for SSR

  server: {
    port: process.env.APP_PORT || 9000 // default: 3000
    // host: '0.0.0.0' // default: localhost
  },
  srcDir: __dirname,

  env: {
    apiUrl: process.env.apiUrl || process.env.APP_URL + '/api',
    appName: process.env.APP_NAME || 'OneClickMarine',
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

  ],

  plugins: [
    '~components/global',
    '~plugins/i18n',
    '~plugins/vform',
    '~plugins/axios',
    '~plugins/fontawesome',
    '~plugins/base',
    '~plugins/nuxt-client-init', // Comment this for SSR
    { src: '~plugins/vuelidate', mode: 'client' },
    { src: '~plugins/vue-quill-editor', ssr: false }

  ],

  modules: [
    '@nuxtjs/router',
    'nuxt-seo',
    [
      'vue-sweetalert2/nuxt',
      {
        confirmButtonColor: '#41b882',
        cancelButtonColor: '#ff7674'
      }
    ]
    // 'nuxt-i18n'
  ],
  seo: {
    // Module options
    baseUrl: 'https://crewmsg.com.ua',
    name: 'Name of site',
    title: 'Lets finish it',
    templateTitle: '%name% - %title%',
    description: 'БЫСТРЫЙ СТАРТ ВАШЕЙ КАРЬЕРЫ В МОРЕ'
    // ...
  },

  i18n: {
    locales: ['en', 'ru', 'de'],
    defaultLocale: 'en',
    vueI18n: {
      fallbackLocale: 'en'
    }
  },

  proxy: {
    '/api': {
      target: 'http://test',
      pathRewrite: {
        '^/api': '/'
      }
    }
  },

  build: {
    extractCSS: true,
    standalone: true
  },

  buildModules: [
    // With options
    ['@nuxtjs/vuetify'],
    '@nuxtjs/moment'
  ],

  vuetify: {
    customVariables: ['~/assets/variables.scss'],
    theme: {
      dark: false,
      light: {
        primary: '#42a5f6',
        secondary: '#050b1f',
        accent: '#204165'
      }

    }
  },

  hooks: {
    generate: {
      done (generator) {
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
