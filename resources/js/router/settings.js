import IndexModel from '../views/settings/Index'

// general settings
import SettingsGeneral from '../views/settings/general/Index'
import CreateSettingGeneral from '../views/settings/general/Create'
import EditSettingGeneral from '../views/settings/general/Edit'

// lead-statuses
import LeadStatuses from '../views/settings/lead-statuses/Index'

// sales-commissions
import SalesCommissions from '../views/settings/sales-commissions/Index'

const routes = [
    ////////////////// settings routes ///////////////////
    {
        path: 'settings',
        name: 'settings-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-settings'
        },
        children: [
            {
                path: 'general',
                name: 'general-settings',
                meta: {
                    permission: 'index-general-settings'
                },
                component: SettingsGeneral
            },
            {
                path: 'general/create',
                name: 'general-settings-create',
                component: CreateSettingGeneral
            },
            {
                path: 'general/:id/edit',
                name: 'general-settings-edit',
                meta: {
                    permission: 'edit-general-settings'
                },
                component: EditSettingGeneral,
                props: true
            },


            {
                path: 'lead-statuses',
                name: 'lead-statuses',
                meta: {
                    permission: 'edit-lead-statuses'
                },
                component: LeadStatuses
            },

            {
                path: 'sales-commissions',
                name: 'sales-commissions',
                meta: {
                    permission: 'edit-sales-commissions'
                },
                component: SalesCommissions
            },

        ]
    },
]

export default routes
