import IndexModel from '../views/marketing/Index'


const routes = [
    ////////////////// marketing routes ///////////////////
    {
        path: 'marketing',
        name: 'marketing-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-marketing'
        },
        children: [

        ]
    },
]

export default routes
