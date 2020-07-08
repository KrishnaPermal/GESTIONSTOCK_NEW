import Vue from 'vue';
import Vuetify from 'vuetify';
import Routes from './routes.js';
import Layout from './layouts/Layout';
import 'vuetify/dist/vuetify.min.css'
import LoadScript from 'vue-plugin-load-script';
import VStripeElements from 'v-stripe-elements/lib';

Vue.use(LoadScript);
Vue.use(Vuetify);
Vue.use(VStripeElements);

const app = new Vue({
    el: '#admin',
    vuetify: new Vuetify({}),
    router: Routes,
    components: { Layout }
})


export default new Vuetify(app);


