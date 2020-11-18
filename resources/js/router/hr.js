// hr
import IndexModel from '../views/hr/Index'

// users
import Users from '../views/hr/users/Index'
import UsersCreate from '../views/hr/users/Create'
import UsersEdit from '../views/hr/users/Edit'
import UsersProfile from '../views/hr/users/Profile'

// departments
import Departments from '../views/hr/departments/Index'
import DepartmentsCreate from '../views/hr/departments/Create'
import DepartmentsEdit from '../views/hr/departments/Edit'


// requests
// import Requests from '../views/hr/requests/Index'
// import RequestsCreate from '../views/hr/requests/Create'
// import RequestsEdit from '../views/hr/requests/Edit'

// attendances
import Attendances from '../views/hr/attendances/Index'
import AttendancesCreate from '../views/hr/attendances/Create'
import AttendancesEdit from '../views/hr/attendances/Edit'


// permissions
import AssignPermissionsToUser from '../views/hr/permissions/AssignPermissionsToUser'
import Roles from '../views/hr/permissions/roles/Index'
import RolesCreate from '../views/hr/permissions/roles/Create'


const routes = [
    ////////////////// users routes ///////////////////
    {
        path: 'hr',
        name: 'hr-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-hr'
        },
        children: [
            /* ==================== users ==================== */
            {
                path: 'users',
                name: 'users',
                meta: {
                    permission: 'index-users'
                },
                component: Users
            },
            {
                path: 'users/create',
                name: 'users-create',
                meta: {
                    permission: 'create-users'
                },
                component: UsersCreate
            },
            {
                path: 'users/:id/edit',
                name: 'users-edit',
                meta: {
                    permission: 'edit-users'
                },
                component: UsersEdit,
                props: true
            },
            {
                path: 'users/:id/profile',
                name: 'users-profile',
                meta: {
                    permission: 'profile-users'
                },
                component: UsersProfile,
                props: true
            },

            /* ==================== departments ==================== */
            {
                path: 'departments',
                name: 'departments',
                meta: {
                    permission: 'index-departments'
                },
                component: Departments
            },
            {
                path: 'departments/create',
                name: 'departments-create',
                meta: {
                    permission: 'create-departments'
                },
                component: DepartmentsCreate
            },
            {
                path: 'departments/:id/edit',
                name: 'departments-edit',
                meta: {
                    permission: 'edit-departments'
                },
                component: DepartmentsEdit,
                props: true
            },

            /* ==================== requests ==================== */
            // {
            //     path: 'requests/:id?',
            //     name: 'requests',
            //     meta: {
            //         permission: 'index-requests'
            //     },
            //     component: Requests
            // },
            // {
            //     path: 'requests/create',
            //     name: 'requests-create',
            //     meta: {
            //         permission: 'create-requests'
            //     },
            //     component: RequestsCreate
            // },
            // {
            //     path: 'requests/:id/edit',
            //     name: 'requests-edit',
            //     meta: {
            //         permission: 'edit-requests'
            //     },
            //     component: RequestsEdit,
            //     props: true
            // },

            /* ==================== attendances ==================== */
            {
                path: 'attendance/:id?',
                name: 'attendances',
                meta: {
                    permission: 'index-attendances'
                },
                component: Attendances
            },
            {
                path: 'attendances/create',
                name: 'attendances-create',
                meta: {
                    permission: 'create-attendances'
                },
                component: AttendancesCreate
            },
            {
                path: 'attendances/:id/edit',
                name: 'attendances-edit',
                meta: {
                    permission: 'edit-attendances'
                },
                component: AttendancesEdit,
                props: true
            },

            /* ==================== vacations ==================== */
            {
                path: 'vacations',
                name: 'vacations',
                component: Users
            },

            /* ==================== evaluations ==================== */
            {
                path: 'evaluations',
                name: 'evaluations',
                component: Users
            },

            /* ==================== payroll ==================== */
            {
                path: 'payroll',
                name: 'payroll',
                component: Users
            },

            /* ==================== permissions ==================== */
            {
                path: 'assign-permissions-to-user/:id',
                name: 'assign-permissions-to-user',
                meta: {
                    permission: 'permission-users'
                },
                component: AssignPermissionsToUser
            },
            {
                path: 'roles',
                name: 'roles',
                meta: {
                    permission: 'index-roles'
                },
                component: Roles
            },
            {
                path: 'roles/create',
                name: 'roles-create',
                meta: {
                    permission: 'create-roles'
                },
                component: RolesCreate
            },


        ]
    },
]

export default routes
