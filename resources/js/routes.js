

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

import DashboardManager from './components/DashboardManager.vue';

import IndexManagerNotifications from './pages/manager/notifications/IndexManagerNotifications.vue';

import IndexManagerUsers from './pages/manager/users/IndexManagerUsers.vue';
import CreateManagerUsers from './pages/manager/users/CreateManagerUsers.vue';
import ShowManagerUsers from './pages/manager/users/ShowManagerUsers.vue';
import EditManagerUsers from './pages/manager/users/EditManagerUsers.vue';

import IndexManagerFees from './pages/manager/fees/IndexManagerFees.vue';
import CreateManagerFees from './pages/manager/fees/CreateManagerFees.vue';
import ShowManagerFees from './pages/manager/fees/ShowManagerFees.vue';
import EditManagerFees from './pages/manager/fees/EditManagerFees.vue';

import IndexManagerPayments from './pages/manager/payments/IndexManagerPayments.vue';
import CreateManagerPayments from './pages/manager/payments/CreateManagerPayments.vue';
import ShowManagerPayments from './pages/manager/payments/ShowManagerPayments.vue';
import EditManagerPayments from './pages/manager/payments/EditManagerPayments.vue';







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

    //MANAGER ROUTES

        //admins
        {
            path: '/manager/dashboard',
            name: 'manager.dashboard',
            component: DashboardManager,
        },
    
        //users
        {
            path: '/manager/users',
            name: 'manager.users.index',
            component: IndexManagerUsers,
        },
        {
            path: '/manager/users/create',
            name: 'manager.users.create',
            component: CreateManagerUsers,
        },
        {
            path: '/manager/users/:id',
            name: 'manager.users.show',
            component: ShowManagerUsers,
        },
        {
            path: '/manager/users/:id/edit',
            name: 'manager.users.edit',
            component: EditManagerUsers,
        },
    
        //fees
        {
            path: '/manager/fees',
            name: 'manager.fees.index',
            component: IndexManagerFees,
        },
        {
            path: '/manager/fees/create',
            name: 'manager.fees.create',
            component: CreateManagerFees,
        },
        {
            path: '/manager/fees/:id',
            name: 'manager.fees.show',
            component: ShowManagerFees,
        },
        {
            path: '/manager/fees/:id/edit',
            name: 'manager.fees.edit',
            component: EditManagerFees,
        },
    
        //payments
        {
            path: '/manager/payments',
            name: 'manager.payments.index',
            component: IndexManagerPayments,
        },
        {
            path: '/manager/payments/create',
            name: 'manager.payments.create',
            component: CreateManagerPayments,
        },
        {
            path: '/manager/payments/:id',
            name: 'manager.payments.show',
            component: ShowManagerPayments,
        },
        {
            path: '/manager/payments/:id/edit',
            name: 'manager.payments.edit',
            component: EditManagerPayments,
        },
    
          //notification 
          {
            path: '/manager/notifications',
            name: 'manager.notifications.index',
            component: IndexManagerNotifications,
        },


]

