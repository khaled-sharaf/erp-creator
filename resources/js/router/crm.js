import IndexModel from '../views/crm/Index'

// leads
import Leads from '../views/crm/leads/Index'
import LeadsCreate from '../views/crm/leads/Create'
import LeadsEdit from '../views/crm/leads/Edit'
import LeadsProfile from '../views/crm/leads/Profile'

// clients
import Clients from '../views/crm/clients/Index'
import ClientsCreate from '../views/crm/clients/Create'
import ClientsEdit from '../views/crm/clients/Edit'
import ClientsProfile from '../views/crm/clients/Profile'

// meetings
import Meetings from '../views/crm/meetings/Index'
import MeetingsCreate from '../views/crm/meetings/Create'
import MeetingsEdit from '../views/crm/meetings/Edit'
import MeetingsProfile from '../views/crm/meetings/Profile'


// services
import Services from '../views/crm/services/Index'
import ServicesCreate from '../views/crm/services/Create'
import ServicesEdit from '../views/crm/services/Edit'

// lead_contracts
import LeadContracts from '../views/crm/lead_contracts/Index'
import LeadContractsCreate from '../views/crm/lead_contracts/Create'
import LeadContractsEdit from '../views/crm/lead_contracts/Edit'
import LeadContractsRenewal from '../views/crm/lead_contracts/Renewal'
import LeadContractsProfile from '../views/crm/lead_contracts/Profile'

// quotations
import Quotations from '../views/crm/quotations/Index'
import QuotationsCreate from '../views/crm/quotations/Create'
import QuotationsEdit from '../views/crm/quotations/Edit'
import QuotationsProfile from '../views/crm/quotations/Profile'

// reports
import Reports from '../views/crm/reports/Index'


const routes = [
    ////////////////// crm routes ///////////////////
    {
        path: 'crm',
        name: 'crm-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-crm'
        },
        children: [

            /* ==================== leads ==================== */
            {
                path: 'leads',
                name: 'leads',
                meta: {
                    permission: 'index-leads'
                },
                component: Leads
            },
            {
                path: 'leads/create',
                name: 'leads-create',
                meta: {
                    permission: 'create-leads'
                },
                component: LeadsCreate
            },
            {
                path: 'leads/:id/edit',
                name: 'leads-edit',
                meta: {
                    permission: 'edit-leads'
                },
                component: LeadsEdit
            },
            {
                path: 'leads/:id/profile',
                name: 'leads-profile',
                meta: {
                    permission: 'profile-leads'
                },
                component: LeadsProfile
            },

            /* ==================== clients ==================== */
            {
                path: 'clients',
                name: 'clients',
                meta: {
                    permission: 'index-clients'
                },
                component: Clients
            },
            {
                path: 'clients/create',
                name: 'clients-create',
                meta: {
                    permission: 'create-clients'
                },
                component: ClientsCreate
            },
            {
                path: 'clients/:id/edit',
                name: 'clients-edit',
                meta: {
                    permission: 'edit-clients'
                },
                component: ClientsEdit
            },
            {
                path: 'clients/:id/profile',
                name: 'clients-profile',
                meta: {
                    permission: 'profile-clients'
                },
                component: ClientsProfile
            },

            /* ==================== meetings ==================== */
            {
                path: 'meetings',
                name: 'meetings',
                meta: {
                    permission: 'index-meetings'
                },
                component: Meetings
            },
            {
                path: 'meetings/create',
                name: 'meetings-create',
                meta: {
                    permission: 'create-meetings'
                },
                component: MeetingsCreate
            },
            {
                path: 'meetings/:id/edit',
                name: 'meetings-edit',
                meta: {
                    permission: 'edit-meetings'
                },
                component: MeetingsEdit
            },
            {
                path: 'meetings/:id/profile',
                name: 'meetings-profile',
                meta: {
                    permission: 'profile-meetings'
                },
                component: MeetingsProfile
            },

            /* ==================== services ==================== */
            {
                path: 'services',
                name: 'services',
                meta: {
                    permission: 'index-services'
                },
                component: Services
            },
            {
                path: 'services/create',
                name: 'services-create',
                meta: {
                    permission: 'create-services'
                },
                component: ServicesCreate
            },
            {
                path: 'services/:id/edit',
                name: 'services-edit',
                meta: {
                    permission: 'edit-services'
                },
                component: ServicesEdit
            },

            /* ==================== lead_contracts ==================== */
            {
                path: 'lead_contracts',
                name: 'lead_contracts',
                meta: {
                    permission: 'index-lead_contracts'
                },
                component: LeadContracts
            },
            {
                path: 'lead_contracts/create/:id?',
                name: 'lead_contracts-create',
                meta: {
                    permission: 'create-lead_contracts'
                },
                component: LeadContractsCreate,
                props: true
            },
            {
                path: 'lead_contracts/:id/edit',
                name: 'lead_contracts-edit',
                meta: {
                    permission: 'edit-lead_contracts'
                },
                component: LeadContractsEdit
            },
            {
                path: 'lead_contracts/:id/renewal',
                name: 'lead_contracts-renewal',
                meta: {
                    permission: 'renewal-lead_contracts'
                },
                component: LeadContractsRenewal
            },
            {
                path: 'lead_contracts/:id/profile',
                name: 'lead_contracts-profile',
                meta: {
                    permission: 'profile-lead_contracts'
                },
                component: LeadContractsProfile
            },

            /* ==================== quotations ==================== */
            {
                path: 'quotations',
                name: 'quotations',
                meta: {
                    permission: 'index-quotations'
                },
                component: Quotations
            },
            {
                path: 'quotations/create/:id?',
                name: 'quotations-create',
                meta: {
                    permission: 'create-quotations'
                },
                component: QuotationsCreate
            },
            {
                path: 'quotations/:id/edit',
                name: 'quotations-edit',
                meta: {
                    permission: 'edit-quotations'
                },
                component: QuotationsEdit
            },
            {
                path: 'quotations/:id/profile',
                name: 'quotations-profile',
                meta: {
                    permission: 'profile-quotations'
                },
                component: QuotationsProfile
            },

            /* ==================== crm_reports ==================== */
            {
                path: 'crm_reports',
                name: 'crm_reports',
                meta: {
                    permission: 'reports-crm'
                },
                component: Reports
            },
        ]
    },
]

export default routes
