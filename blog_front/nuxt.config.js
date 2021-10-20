import * as config from './store/cofig';
export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'blog',
    htmlAttrs: {
      lang: 'pl'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    
  ],

  loading: { color: 'green', continuous: true },

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~plugins/components.js',
    '~plugins/validate.js'
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    '@nuxtjs/moment'
  ],

  moment: {
    defaultLocale: 'pl',
    locales: ['pl']
  },

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/bootstrap
    'bootstrap-vue/nuxt',
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',

    '@nuxtjs/auth-next',
   
  ],

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    baseURL: config.API_ENDPOINT_API, // ['@/plugins/cofig'].API_ENDPOINT_API
    credentials: true,
  },
  auth: {
    strategies: {
      laravelSanctum: {
        provider: "laravel/sanctum",
        url: "https://api.andrii-24.com",// config.API_ENDPOINT,
        endpoints: {
          login: {
            url: "/api/login"
          },
          logout: {
            url: "/api/logout"
          },
          user: {
            url: "/api/user"
          }
        },
        user: {
          property: false
        }
      }
    }
  },
  target: 'static',
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: ['vee-validate']
  },

}
