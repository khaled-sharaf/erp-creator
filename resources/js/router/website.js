import IndexModel from '../views/website/Index'


const routes = [
    ////////////////// website routes ///////////////////
    {
        path: 'website',
        name: 'website-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-cp-website'
        },
        children: [

        ]
    },
]

export default routes
