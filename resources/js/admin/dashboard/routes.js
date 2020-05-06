import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from './views/Dashboard.vue';
import Home from "./views/Home.vue";
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            children: [{
                    path: '/dashboard/users',
                    name: 'users',
                    component: Users
                },
                {
                    path: '/dashboard/activities',
                    name: 'activities',
                    component: Activities
                },
            ]
        },


    ]
})

export default router;