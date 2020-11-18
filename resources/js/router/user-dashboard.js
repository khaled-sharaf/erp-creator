import UserDashboard from '../views/user-dashboard/Index'


const routes = [
    ////////////////// users dashboard routes ///////////////////
    {
        path: 'user-dashboard',
        name: 'user-dashboard-model',
        meta: {
            permission: 'show-module-dashboard'
        },
        component: UserDashboard
    },
]

export default routes
