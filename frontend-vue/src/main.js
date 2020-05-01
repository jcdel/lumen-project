import Vue from 'vue'
import App from './App.vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import router from './router/index'
import store from './store/index'

library.add(fas)
dom.watch()

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  BootstrapVue,
  render: h => h(App)
}).$mount('#app')
