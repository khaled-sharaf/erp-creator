import IndexModel from '../views/plans/Index'


const routes = [
    ////////////////// plans routes ///////////////////
    {
        path: 'plans',
        name: 'plans-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-plans'
        },
        children: [

        ]
    }
]

export default routes
