import IndexModel from '../views/documents/Index'


const routes = [
    ////////////////// documents routes ///////////////////
    {
        path: 'documents',
        name: 'documents-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-documents'
        },
        children: [

        ]
    },
]

export default routes
