export const protectedRoute = [
    {
        path: '/dashboard',
        name: 'dashboard',
        meta: {
            title: 'dashboard',
            icon: 'mdi-view-dashboard',
        },
    },
    {
        path: '/patients-search',
        name: 'patients-search.index',
        meta: {
            title: 'patients_search',
            icon: 'mdi-magnify',
        },
    },
    {
        path: '/patients',
        name: 'patients.index',
        meta: {
            title: 'patients',
            icon: 'mdi-format-list-bulleted',
        },
    },
    {
        path: '/patients/register',
        name: 'patients.create',
        meta: {
            title: 'register_patient',
            icon: 'mdi-plus',
        },
    },
    {
        path: '/admin',
        name: 'admin.dashboard',
        meta: {
            title: 'admin',
            icon: 'mdi-application-settings',
            hidden: false,
            //permissions: ['view menu permissions'],
        },
        children: [
            {
                path: '/admin/dashboard',
                name: 'admin-dashboard.index',
                meta: {
                    title: 'dashboard',
                    icon: 'mdi-view-dashboard',
                    hidden: false,
                    //permissions: ['view menu permissions'],
                },
            },
            {
                path: '/admin/page-permissions',
                name: 'page-permissions.index',
                meta: {
                    title: 'page-permissions',
                    icon: 'mdi-account-lock',
                    hidden: false,
                    //permissions: ['view menu permissions'],
                },
            },
            {
                path: '/admin/role-permissions',
                name: 'role-permissions.index',
                meta: {
                    title: 'role_permissions',
                    icon: 'mdi-account-lock',
                    hidden: false,
                    //permissions: ['view menu roles']
                },
            },
            {
                path: '/admin/users',
                name: 'users.index',
                meta: {
                    title: 'all_users',
                    icon: 'mdi-account-group',
                    hidden: false,
                    permissions: ['view menu users']
                },
            }
        ],
    },
]
