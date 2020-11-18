// const domain = 'http://localhost:8000'

require('./bootstrap');
window.Vue = require('vue');

/**************************************************************************************/
// configrations
import './env.js'
/**************************************************************************************/


import i18n from './plugins/i18n' // localization
import App from './App.vue'
import router from './router/index'

/**************************************************************************************/

// select 2
import './plugins/select2/select2.min.css'
import './plugins/select2/select2.min.js'

// overlayScrollbars
import './plugins/overlayScrollbars/OverlayScrollbars.min.css'
import './plugins/overlayScrollbars/jquery.overlayScrollbars.min.js'

// json-excel
import './plugins/excel-export.js'

// print vue
import './plugins/vue-print.js'

// vue2-editor
import './plugins/vue2-editor.js'

// vSelect
import './plugins/vSelect.js'


import './plugins/progressBar.js'
import './plugins/waves-effect.js'


/**************************************************************************************/
import './plugins/sweetalert2.js'

/**************************************************************************************/
import './plugins/vue-select.js'
/**************************************************************************************/

import './plugins/vue-slide.js'
/**************************************************************************************/

import './plugins/money.js'
/**************************************************************************************/

import './components.js'
import './filters.js'
import './directives.js'
import './globalVars.js'
import './globalMethods.js'

/**************************************************************************************/
// paginate

import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)
/**************************************************************************************/

import { Form, HasError, AlertError, AlertErrors, AlertSuccess } from "vform";
window.Form = Form;
// vue form
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);

Vue.component('navbar', require('./components/Navbar.vue').default);

Vue.component('paginate-v2', require('laravel-vue-pagination'));

/**************************************************************************************/
import DatePicker from 'vue2-datepicker';
Vue.component(DatePicker.name, DatePicker);

if (localStorage.getItem('locale') != null && localStorage.getItem('locale') === 'ar') {
    Vue.prototype.$langDatePicker = {
        days: ['حد', 'اثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة', 'سبت'],
        months: ['يناير', 'فبراير', 'مارس', 'إبريل', 'مايو', 'يوينو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر']
    }
} else {
    Vue.prototype.$langDatePicker = {}
}
/**************************************************************************************/


import './global-components.js'

import modal from 'vue-js-modal'

// select pagination
import vSelectPage from 'v-selectpage';
Vue.use(vSelectPage);

Vue.use(modal, {dialog: true, dynamic: true});

window.SharedEvent = new class {
  constructor() {
    this.vue = new Vue();
  }
  fire(event, data = null) {
    this.vue.$emit(event, data);
  }
  listen(event, callback) {
    this.vue.$on(event, callback);
  }
  off(event, callback) {
    this.vue.$off(event, callback);
  }
}

const app = new Vue({
  i18n,
  router,

  render: h => h(App)
}).$mount('#app')
