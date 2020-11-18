import Vue from 'vue'
import Router from 'vue-router'


// global router
/***********************************************************************/

// default layout and dashboard
import DefaultLayout from '../layouts/DefaultLayout'
import Dashboard from '../views/Dashboard'


// models router
/************************************************************************************/

/*** hr routes *************************************/
import hr from './hr'

/*** accounting routes *************************************/
import accounting from './accounting'

/*** calendar routes *************************************/
import calendar from './calendar'

/*** crm routes *************************************/
import crm from './crm'

/*** designs routes *************************************/
import designs from './designs'

/*** marketing routes *************************************/
import marketing from './marketing'

/*** projects_management routes *************************************/
import projects_management from './projects_management'

/*** web_development routes *************************************/
import web_development from './web_development'

/*** website routes *************************************/
import website from './website'

/*** plans routes *************************************/
import plans from './plans'

/*** documents routes *************************************/
import documents from './documents'

/*** notes routes *************************************/
import notes from './notes'

/*** user-dashboard routes *************************************/
import user_dashboard from './user-dashboard'

/*** settings routes *************************************/
import settings from './settings'


/************************************************************************************/


const routesArray = [
    {
        path: '/dashboard',
        name: 'home',
        component: Dashboard
    },
]
.concat(hr)
.concat(accounting)
.concat(calendar)
.concat(crm)
.concat(designs)
.concat(marketing)
.concat(projects_management)
.concat(web_development)
.concat(website)
.concat(plans)
.concat(notes)
.concat(documents)
.concat(user_dashboard)
.concat(settings)
/***************************************************************************/


Vue.use(Router)

var pathRoute = '/'

if (process.env.NODE_ENV === 'development' && window.port == 'php') {
    pathRoute = window.js_locale_path
}

const vueRouter = new Router({
    mode: 'history',
    base: pathRoute + window.cp_prefix,
    // base: process.env.BASE_URL,
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'default-layout',
            component: DefaultLayout,
            children: routesArray
        },
        {
            path: '*',
            redirect: { name: 'home' }
        }
    ]
})

vueRouter.afterEach((to, from) => {
    setTimeout(() => {
        const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title)
        // If a route with a title was found, set the document (page) title to that value.
        if(nearestWithTitle) document.title = nearestWithTitle.meta.title
    })
});

vueRouter.beforeEach((to, from, next) => {
    const nearestWithPermission = to.matched.slice().reverse().find(r => r.meta && r.meta.permission)
    if (nearestWithPermission) {
        if ($can(nearestWithPermission.meta.permission)) {
            next()
        } else {
            next({ name: 'home' })
        }
    }
    next()
});


export default vueRouter
