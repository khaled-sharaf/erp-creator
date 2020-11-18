<?php
    return [

        'permissionsActive' => env('PERMISSIONS_ACTIVE'),

        'group-permissions' => [

            // admins
            'admins' => [
                'admin-dashboard',
                'admin-hr',
                'admin-crm',
                'admin-accounting',
                'admin-projects-management',
                'admin-designs',
                'admin-marketing',
                'admin-documents',
                'admin-notes',
                'admin-cp-website',
                'admin-web-development',
                'admin-calendar',
                'admin-settings',
            ],

            // show modules
            'modules' => [
                'show-module-dashboard', // done
                'show-module-hr', // done
                'show-module-crm', // done
                'show-module-accounting', // done
                'show-module-projects-management', // done
                'show-module-designs', // done
                'show-module-marketing', // done
                'show-module-documents', // done
                'show-module-notes', // done
                'show-module-cp-website', // done
                'show-module-web-development', // done
                'show-module-calendar', // done
                'show-module-settings', // done
            ],

            // reports
            'reports' => [
                'reports-hr',
                'reports-crm', // done
                'reports-accounting', // done
                'reports-projects-management', // done
                'reports-designs',
                'reports-marketing',
                'reports-documents',
                'reports-cp-website',
                'reports-web-development'
            ],

            'settings' => [
                'index-general-settings', // done
                'edit-general-settings', // done
                'edit-lead-statuses', // done
                'edit-sales-commissions' // done
            ],


            // permissions
            'permissions' => [
                'index-roles', // done
                'edit-roles', // done
                'create-roles', // done
                'delete-roles' // done
            ],


            // hr
            'users' => [
                'index-users', // done
                'create-users', // done
                'edit-users', // done
                'profile-users', // done
                'permission-users', // done
                'delete-users', // done
                'restore-users', // done
                'force-delete-users', // done
            ],

            'departments' => [
                'index-departments', // done
                'create-departments', // done
                'edit-departments', // done
                'delete-departments', // done
                'restore-departments', // done
                'force-delete-departments', // done
            ],

            'requests' => [
                'index-requests',
                'create-requests',
                'edit-requests',
                'profile-requests',
                'delete-requests'
            ],

            'attendances' => [
                'index-attendances',
                'create-attendances',
                'edit-attendances',
                'delete-attendances'
            ],



            // crm
            'leads' => [
                'index-leads', // done
                'create-leads', // done
                'edit-leads', // done
                'profile-leads', // done
                'delete-leads', // done
                'restore-leads', // done
                'force-delete-leads', // done
            ],

            'clients' => [
                'index-clients', // done
                'create-clients', // done
                'edit-clients', // done
                'profile-clients', // done
                'delete-clients', // done
                'restore-clients', // done
                'force-delete-clients', // done
            ],

            'meetings' => [
                'index-meetings', // done
                'create-meetings', // done
                'edit-meetings', // done
                'profile-meetings', // done
                'delete-meetings', // done
                'restore-meetings', // done
                'force-delete-meetings', // done
            ],

            'services' => [
                'index-services', // done
                'create-services', // done
                'edit-services', // done
                'delete-services', // done
                'restore-services', // done
                'force-delete-services', // done
            ],

            'quotations' => [
                'index-quotations', // done
                'create-quotations', // done
                'edit-quotations', // done
                'profile-quotations', // done
                'delete-quotations', // done
            ],

            'lead_contracts' => [
                'index-lead_contracts', // done
                'create-lead_contracts', // done
                'edit-lead_contracts', // done
                'profile-lead_contracts', // done
                'delete-lead_contracts', // done
                'restore-lead_contracts', // done
                'force-delete-lead_contracts', // done

                'receipt-lead_contracts', // done
                'payment-lead_contracts', // done
                'add-payment-lead_contracts', // done
                'delete-payment-lead_contracts', // done

                'invoice-lead_contracts', // done
                'view-pdf-lead_contracts', // done
                'download-pdf-lead_contracts', // done
            ],



            // projects management

            'projects' => [
                'index-projects', // done
                'create-projects', // done
                'edit-projects', // done
                'profile-projects', // done
                'delete-projects', // done
                'restore-projects', // done
                'force-delete-projects', // done
            ],

            'platforms' => [
                'edit-platforms' // done
            ],




            // accounting

            'banks' => [
                'index-banks',
                'create-banks',
                'edit-banks',
                'profile-banks',
                'delete-banks',
                'restore-banks',
                'force-delete-banks',
            ],

            'cashs' => [
                'index-cashs',
                'create-cashs',
                'edit-cashs',
                'profile-cashs',
                'delete-cashs',
                'restore-cashs',
                'force-delete-cashs',
            ],

            'partners' => [
                'index-partners',
                'create-partners',
                'edit-partners',
                'profile-partners',
                'delete-partners',
                'restore-partners',
                'force-delete-partners',
            ],


            'payments' => [
                'index-account-payments',
                'create-payments',
                'edit-payments',
                'delete-payments',
                'restore-payments',
                'force-delete-payments',
            ],

            'sales' => [
                'index-sales'
            ],

            'sales_returns' => [
                'index-sales_returns'
            ],

            'purchases' => [
                'index-purchases'
            ],

            'purchase_returns' => [
                'index-purchase_returns'
            ],

            'suppliers' => [
                'index-suppliers',
                'create-suppliers',
                'edit-suppliers',
                'profile-suppliers',
                'delete-suppliers',
                'restore-suppliers',
                'force-delete-suppliers',
            ],

            'expenses' => [
                'index-expenses',
                'create-expenses',
                'edit-expenses',
                'delete-expenses',
            ],

            'fixed_assets' => [
                'index-fixed_assets',
                'create-fixed_assets',
                'edit-fixed_assets',
                'delete-fixed_assets',
            ],

            'purchase_orders' => [
                'index-purchase_orders',
                'create-purchase_orders',
                'edit-purchase_orders',
                'profile-purchase_orders',
                'delete-purchase_orders',
            ],


            'todos' => [
                'index-todos'
            ],

            // Designs
            'logos' => [
              'index-logos', // done
              'profile-logos', // done
            ],

            'social-media' => [
              'index-social-media', // done
              'profile-social-media', // done
            ],

            'printing' => [
              'index-printing', // done
              'profile-printing', // done
            ],


            // Web Development
            'websites' => [
              'index-websites', // done
              'profile-websites', // done
            ],

            'hostings' => [
              'index-hostings', // done
              'profile-hostings', // done
              'create-hostings', // done
              'edit-hostings', // done
            ],

            'domains' => [
              'index-domains', // done
              'profile-domains', // done
              'create-domains', // done
              'edit-domains', // done
            ],
        ]

    ];
