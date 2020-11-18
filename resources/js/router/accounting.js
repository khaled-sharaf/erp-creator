import IndexModel from '../views/accounting/Index'


// lead_contracts
import Contracts from '../views/accounting/contracts/Index'
import ContractsProfile from '../views/accounting/contracts/Profile'
import ContractsPayments from '../views/accounting/contracts/payments/Index'


// banks
import Banks from '../views/accounting/banks/Index'
import BanksCreate from '../views/accounting/banks/Create'
import BanksEdit from '../views/accounting/banks/Edit'

// cashs
import Cashs from '../views/accounting/cashs/Index'
import CashsCreate from '../views/accounting/cashs/Create'
import CashsEdit from '../views/accounting/cashs/Edit'

// partners
import Partners from '../views/accounting/partners/Index'
import PartnersCreate from '../views/accounting/partners/Create'
import PartnersEdit from '../views/accounting/partners/Edit'


// payments
import Payments from '../views/accounting/expenses/Index'
import PaymentsCreate from '../views/accounting/expenses/Create'
import PaymentsEdit from '../views/accounting/expenses/Edit'

// sales
import Sales from '../views/accounting/expenses/Index'

// sales_returns
import SalesReturns from '../views/accounting/expenses/Index'

// purchases
import Purchases from '../views/accounting/expenses/Index'

// purchase_returns
import PurchaseReturns from '../views/accounting/expenses/Index'

// expenses
import Expenses from '../views/accounting/expenses/Index'
import ExpensesCreate from '../views/accounting/expenses/Create'
import ExpensesEdit from '../views/accounting/expenses/Edit'


// FixedAssets
import FixedAssets from '../views/accounting/expenses/Index'
import FixedAssetsCreate from '../views/accounting/expenses/Create'
import FixedAssetsEdit from '../views/accounting/expenses/Edit'


// suppliers
import Suppliers from '../views/accounting/suppliers/Index'
import SuppliersCreate from '../views/accounting/suppliers/Create'
import SuppliersEdit from '../views/accounting/suppliers/Edit'
import SuppliersProfile from '../views/accounting/suppliers/Profile'


const routes = [
    ////////////////// accounting routes ///////////////////
    {
        path: 'accounting',
        name: 'accounting-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-accounting'
        },
        children: [
            /* ==================== contracts ==================== */
            {
                path: 'contracts',
                name: 'contracts',
                meta: {
                    permission: 'index-lead_contracts'
                },
                component: Contracts
            },
            {
                path: 'contracts/:id/profile',
                name: 'contracts-profile',
                meta: {
                    permission: 'profile-lead_contracts'
                },
                component: ContractsProfile
            },
            {
                path: 'contracts/:id/payments',
                name: 'contracts-payments',
                meta: {
                    permission: 'payment-lead_contracts'
                },
                component: ContractsPayments
            },

            /* ==================== banks ==================== */
            {
                path: 'banks',
                name: 'banks',
                meta: {
                    permission: 'index-banks'
                },
                component: Banks
            },
            {
                path: 'banks/create',
                name: 'banks-create',
                meta: {
                    permission: 'create-banks'
                },
                component: BanksCreate
            },
            {
                path: 'banks/:id/edit',
                name: 'banks-edit',
                meta: {
                    permission: 'edit-banks'
                },
                component: BanksEdit,
                props: true
            },

            /* ==================== cashes ==================== */
            {
                path: 'cashes',
                name: 'cashs',
                meta: {
                    permission: 'index-cashs'
                },
                component: Cashs
            },
            {
                path: 'cashes/create',
                name: 'cashs-create',
                meta: {
                    permission: 'create-cashs'
                },
                component: CashsCreate
            },
            {
                path: 'cashes/:id/edit',
                name: 'cashs-edit',
                meta: {
                    permission: 'edit-cashs'
                },
                component: CashsEdit,
                props: true
            },

            /* ==================== partners ==================== */
            {
                path: 'partners',
                name: 'partners',
                meta: {
                    permission: 'index-partners'
                },
                component: Partners
            },
            {
                path: 'partners/create',
                name: 'partners-create',
                meta: {
                    permission: 'create-partners'
                },
                component: PartnersCreate
            },
            {
                path: 'partners/:id/edit',
                name: 'partners-edit',
                meta: {
                    permission: 'edit-partners'
                },
                component: PartnersEdit,
                props: true
            },

            /* ==================== payments ==================== */
            {
                path: 'payments/:id', // account id
                name: 'payments',
                meta: {
                    permission: 'index-account-payments'
                },
                component: Payments
            },
            {
                path: 'payments/create',
                name: 'payments-create',
                meta: {
                    permission: 'create-payments'
                },
                component: PaymentsCreate
            },
            {
                path: 'payments/:id/edit',
                name: 'payments-edit',
                meta: {
                    permission: 'edit-payments'
                },
                component: PaymentsEdit,
                props: true
            },

            /* ==================== sales ==================== */
            {
                path: 'sales',
                name: 'sales',
                meta: {
                    permission: 'index-sales'
                },
                component: Sales
            },

            /* ==================== sales_returns ==================== */
            {
                path: 'sales_returns',
                name: 'sales_returns',
                meta: {
                    permission: 'index-sales_returns'
                },
                component: SalesReturns
            },

            /* ==================== purchases ==================== */
            {
                path: 'purchases',
                name: 'purchases',
                meta: {
                    permission: 'index-purchases'
                },
                component: Purchases
            },

            /* ==================== purchase_returns ==================== */
            {
                path: 'purchase_returns',
                name: 'purchase_returns',
                meta: {
                    permission: 'index-purchase_returns'
                },
                component: PurchaseReturns
            },

            /* ==================== expenses ==================== */
            {
                path: 'expenses',
                name: 'expenses',
                meta: {
                    permission: 'index-expenses'
                },
                component: Expenses
            },
            {
                path: 'expenses/create',
                name: 'expenses-create',
                meta: {
                    permission: 'create-expenses'
                },
                component: ExpensesCreate
            },
            {
                path: 'expenses/:id/edit',
                name: 'expenses-edit',
                meta: {
                    permission: 'edit-expenses'
                },
                component: ExpensesEdit,
                props: true
            },

            /* ==================== fixed_assets ==================== */
            {
                path: 'fixed_assets',
                name: 'fixed_assets',
                meta: {
                    permission: 'index-fixed_assets'
                },
                component: FixedAssets
            },
            {
                path: 'fixed_assets/create',
                name: 'fixed_assets-create',
                meta: {
                    permission: 'create-fixed_assets'
                },
                component: FixedAssetsCreate
            },
            {
                path: 'fixed_assets/:id/edit',
                name: 'fixed_assets-edit',
                meta: {
                    permission: 'edit-fixed_assets'
                },
                component: FixedAssetsEdit,
                props: true
            },

            /* ==================== suppliers ==================== */
            {
                path: 'suppliers',
                name: 'suppliers',
                meta: {
                    permission: 'index-suppliers'
                },
                component: Suppliers
            },
            {
                path: 'suppliers/create',
                name: 'suppliers-create',
                meta: {
                    permission: 'create-suppliers'
                },
                component: SuppliersCreate
            },
            {
                path: 'suppliers/:id/edit',
                name: 'suppliers-edit',
                meta: {
                    permission: 'edit-suppliers'
                },
                component: SuppliersEdit,
                props: true
            },
            {
                path: 'suppliers/:id/profile',
                name: 'suppliers-profile',
                meta: {
                    permission: 'profile-suppliers'
                },
                component: SuppliersProfile,
                props: true
            },

            /* ==================== purchase_orders ==================== */
            {
                path: 'purchase_orders',
                name: 'purchase_orders',
                meta: {
                    permission: 'index-purchase_orders'
                },
                component: IndexModel
            },
            {
                path: 'purchase_orders/create',
                name: 'purchase_orders-create',
                meta: {
                    permission: 'create-purchase_orders'
                },
                component: IndexModel
            },
            {
                path: 'purchase_orders/:id/edit',
                name: 'purchase_orders-edit',
                meta: {
                    permission: 'edit-purchase_orders'
                },
                component: IndexModel,
                props: true
            },
            {
                path: 'purchase_orders/:id/profile',
                name: 'purchase_orders-profile',
                meta: {
                    permission: 'profile-purchase_orders'
                },
                component: IndexModel,
                props: true
            },

            /* ==================== supplier_reports ==================== */
            {
                path: 'supplier_reports',
                name: 'supplier_reports',
                component: IndexModel
            },

            /* ==================== client_reports ==================== */
            {
                path: 'client_reports',
                name: 'client_reports',
                component: IndexModel
            },

            /* ==================== income_list ==================== */
            {
                path: 'income_list',
                name: 'income_list',
                component: IndexModel
            },

            /* ==================== budget ==================== */
            {
                path: 'budget',
                name: 'budget',
                component: IndexModel
            },

            /* ==================== taxes ==================== */
            {
                path: 'taxes',
                name: 'taxes',
                component: IndexModel
            },

        ]
    },
]

export default routes
