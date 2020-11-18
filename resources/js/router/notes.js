import IndexModel from '../views/notes/Index'


// Todos
import Todos from '../views/notes/todos/Index'

const routes = [
    ////////////////// notes routes ///////////////////
    {
        path: 'notes',
        name: 'notes-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-notes'
        },
        children: [
            {
                path: 'todos',
                name: 'todos',
                meta: {
                    permission: 'index-todos'
                },
                component: Todos
            }
        ]
    },
]

export default routes
