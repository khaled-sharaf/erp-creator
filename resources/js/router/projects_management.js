import IndexModel from '../views/projects_management/Index'


// platforms
import Platforms from '../views/projects_management/platforms/Index'


// projects
import Projects from '../views/projects_management/projects/Index'
import ProjectsEdit from '../views/projects_management/projects/Edit'
import ProjectsProfile from '../views/projects_management/projects/Profile'

const routes = [
    ////////////////// projects_management routes ///////////////////
    {
        path: 'projects_management',
        name: 'projects_management-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-projects-management'
        },
        children: [
            /* ==================== platforms ==================== */
            {
                path: 'platforms',
                name: 'platforms',
                meta: {
                    permission: 'edit-platforms'
                },
                component: Platforms
            },

            /* ==================== projects ==================== */
            {
                path: 'projects',
                name: 'projects',
                meta: {
                    permission: 'index-projects'
                },
                component: Projects
            },
            {
                path: 'projects/:id/edit',
                name: 'projects-edit',
                meta: {
                    permission: 'edit-projects'
                },
                component: ProjectsEdit
            },
            {
                path: 'projects/:id/profile',
                name: 'projects-profile',
                meta: {
                    permission: 'profile-projects'
                },
                component: ProjectsProfile
            },
            
            /* ==================== reports-projects-management ==================== */
            {
                path: 'reports-projects-management',
                name: 'reports-projects-management',
                meta: {
                    permission: 'reports-projects-management'
                },
                component: Platforms
            },
        ]
    },
]

export default routes
