import IndexModel from '../views/web_development/Index'

// Websites
import Websites from '../views/web_development/websites/Index'
import WebsitesProfile from '../views/web_development/websites/Profile'

// Hostings
import Hostings from '../views/web_development/hostings/Index'
import HostingsCreate from '../views/web_development/hostings/Create'
import HostingsEdit from '../views/web_development/hostings/Edit'
import HostingsProfile from '../views/web_development/hostings/Profile'

// Hostings
import Domains from '../views/web_development/domains/Index'
import DomainsCreate from '../views/web_development/domains/Create'
import DomainsEdit from '../views/web_development/domains/Edit'
import DomainsProfile from '../views/web_development/domains/Profile'

// reports
import Reports from '../views/web_development/reports/Index'

const routes = [
    ////////////////// web_development routes ///////////////////
    {
        path: 'web_development',
        name: 'web_development-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-web-development'
        },
        children: [
            /* ==================== websites ==================== */
            {
                path: 'websites',
                name: 'websites',
                meta: {
                    permission: 'index-websites'
                },
                component: Websites
            },
            {
              path: 'websites/:id/profile',
              name: 'websites-profile',
              meta: {
                  permission: 'profile-websites'
              },
              component: WebsitesProfile,
            },
            /* ==================== hostings ==================== */
            {
                path: 'hostings',
                name: 'hostings',
                meta: {
                    permission: 'index-hostings'
                },
                component: Hostings
            },
            {
              path: 'hostings/create',
              name: 'hostings-create',
              meta: {
                  permission: 'create-hostings'
              },
              component: HostingsCreate
            },
            {
              path: 'hostings/:id/edit',
              name: 'hostings-edit',
              meta: {
                  permission: 'edit-hostings'
              },
              component: HostingsEdit
            },
            {
                path: 'hostings/:id/profile',
                name: 'hostings-profile',
                meta: {
                    permission: 'profile-hostings'
                },
                component: HostingsProfile
            },

            /* ==================== domains ==================== */
            {
              path: 'domains',
              name: 'domains',
              meta: {
                  permission: 'index-domains'
              },
              component: Domains
            },
            {
              path: 'domains/create',
              name: 'domains-create',
              meta: {
                  permission: 'create-domains'
              },
              component: DomainsCreate
            },
            {
              path: 'domains/:id/edit',
              name: 'domains-edit',
              meta: {
                  permission: 'edit-domains'
              },
              component: DomainsEdit
            },
            {
                path: 'domains/:id/profile',
                name: 'domains-profile',
                meta: {
                    permission: 'profile-domains'
                },
                component: DomainsProfile
            },

            /* ==================== web_reports ==================== */
            {
              path: 'web_reports',
              name: 'web_reports',
              meta: {
                  permission: 'reports-web-development'
              },
              component: Reports
            },
        ]
    },
]

export default routes
