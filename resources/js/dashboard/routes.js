import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from "./views/Home.vue";
import Dashboard from './views/Dashboard.vue';
import Gestion from './views/Gestion.vue';
import Card from "./views/Card.vue";
import dashboardFournisseur from './views/dashboardFournisseur.vue';
import managementsClients from './views/managementsClients.vue';
import Basket from './views/BasketOrder.vue';
import Stepper from './views/components/Stepper.vue';
import Login from "./login/Login.vue";
import Register from "./views/Register.vue";
import { Role } from './_helpers/role';
import { authenticationService } from '../dashboard/_services/authentication.service'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'accueil',
            component: Home,
            //meta: { authorize: [] }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: { authorize: [Role.Admin] },
            children: [
                {
                    path: '/dashboard/',
                    name: 'gestion',
                    component: Gestion,
                },
            ]
        },
        
        {
            path: '/articles',
            name: 'articles',
            component: Card,
        },

        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: { authorize: [] }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: { authorize: [] }
        },
        {
            path: '/dashboardFournisseur',
            name: 'fournisseur',
            component: dashboardFournisseur,
            meta: { authorize: [Role.Fournisseur] }
        },
        {
            path: '/managementsClients',
            name: 'managementsClients',
            component: managementsClients,
            //meta: { authorize: [Role.Admin] }
        }, 
        
        {
            path:'/basket',
            name: 'basket',
            component: Basket,
        },

        {
            path: '/confirmation',
            name: 'stepper',
            component: Stepper,
            meta: { authorize: [Role.Producteur,Role.Admin,Role.Client] }
        },
    ]
})


router.beforeEach((to, from, next) => {

    // redirect to login page if not logged in and trying to access a restricted page
    const { authorize } = to.meta;

    if (authorize && !_.isEmpty(authorize)) {

        const currentUser = authenticationService.currentUserValue;

        if (!currentUser) {
            // not logged in so redirect to login page with the return url
            return next({ path: "/login", query: { returnUrl: to.path } });
        }

        // check if route is restricted by role
        if (authorize.length && !authorize.includes(currentUser.role.name)) {
            // role not authorised so redirect to home page
            return next({ path: "/" });
        }

    }

    return next();
});




export default router;



