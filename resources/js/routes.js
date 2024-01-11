

//IMPORT COMPONENT FOR ADMIN ROUTES
import Login from './pages/auth/Login.vue';
import DashboardAdmin from './components/DashboardAdmin.vue';

import IndexNotifications from './pages/admin/notifications/IndexNotifications.vue';

import IndexUsers from './pages/admin/users/IndexUsers.vue';
import CreateUsers from './pages/admin/users/CreateUsers.vue';
import ShowUsers from './pages/admin/users/ShowUsers.vue';
import EditUsers from './pages/admin/users/EditUsers.vue';

import IndexFees from './pages/admin/fees/IndexFees.vue';
import CreateFees from './pages/admin/fees/CreateFees.vue';
import ShowFees from './pages/admin/fees/ShowFees.vue';
import EditFees from './pages/admin/fees/EditFees.vue';

import IndexPayments from './pages/admin/payments/IndexPayments.vue';
import CreatePayments from './pages/admin/payments/CreatePayments.vue';
import ShowPayments from './pages/admin/payments/ShowPayments.vue';
import EditPayments from './pages/admin/payments/EditPayments.vue';







export default [


    //admins

  
    //auth
    {
        path: '/login',
        name: 'users.login',
        component: Login,
    },

    // ADMIN ROUTES

    //admins
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: DashboardAdmin,
    },

    //users
    {
        path: '/admin/users',
        name: 'admin.users.index',
        component: IndexUsers,
    },
    {
        path: '/admin/users/create',
        name: 'admin.users.create',
        component: CreateUsers,
    },
    {
        path: '/admin/users/:id',
        name: 'admin.users.show',
        component: ShowUsers,
    },
    {
        path: '/admin/users/:id/edit',
        name: 'admin.users.edit',
        component: EditUsers,
    },

    //fees
    {
        path: '/admin/fees',
        name: 'admin.fees.index',
        component: IndexFees,
    },
    {
        path: '/admin/fees/create',
        name: 'admin.fees.create',
        component: CreateFees,
    },
    {
        path: '/admin/fees/:id',
        name: 'admin.fees.show',
        component: ShowFees,
    },
    {
        path: '/admin/fees/:id/edit',
        name: 'admin.fees.edit',
        component: EditFees,
    },

    //payments
    {
        path: '/admin/payments',
        name: 'admin.payments.index',
        component: IndexPayments,
    },
    {
        path: '/admin/payments/create',
        name: 'admin.payments.create',
        component: CreatePayments,
    },
    {
        path: '/admin/payments/:id',
        name: 'admin.payments.show',
        component: ShowPayments,
    },
    {
        path: '/admin/payments/:id/edit',
        name: 'admin.payments.edit',
        component: EditPayments,
    },

      //notification 
      {
        path: '/admin/notifications',
        name: 'admin.notifications.index',
        component: IndexNotifications,
    },

]

