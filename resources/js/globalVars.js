
import Vue from 'vue'
import i18n from './plugins/i18n.js' // localization


/**************************************************************************************/
window.$paymentMethods = {
	1 : i18n.t('global.payment_methods.cash'),
	2 : i18n.t('global.payment_methods.bank'),
	3 : i18n.t('global.payment_methods.partner_drawing')
}
Vue.prototype.$paymentMethods = $paymentMethods
/**************************************************************************************/

/**************************************************************************************/
window.$postsTypeInProjects = {
	1 : i18n.t('global.projects_posts_type.single'),
	2 : i18n.t('global.projects_posts_type.grouped'),
	3 : i18n.t('global.projects_posts_type.cover_post')
}
Vue.prototype.$postsTypeInProjects = $postsTypeInProjects
/**************************************************************************************/
