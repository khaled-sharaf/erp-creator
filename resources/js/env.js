import Vue from 'vue'

Vue.config.productionTip = false

// global properties

Vue.prototype.$domain = window.url
Vue.prototype.$auth = window.$auth
Vue.prototype.$settings = window.$settings
Vue.prototype.$user_permissions = window.$user_permissions
// Vue.prototype.$domain_admin = window.url + window.cp_prefix + '/'
Vue.prototype.$domain_admin = window.url
Vue.prototype.$nameSettingsInDB = 'data_tabel_settings_view_columns'

/**************************************************************************************/
// permissions active
Vue.prototype.$permissionsActive = window.$permissions_active
/**************************************************************************************/


