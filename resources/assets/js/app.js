import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import App from './components/App'
import VueAuth from '@websanova/vue-auth'
import axios from 'axios'
import Register from './components/Register'
import Login from './components/Login'
import DashBoard from './components/Dashboard'

Vue.use(Vuetify);
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
axios.defaults.baseURL = 'http://localhost:8000/api';
const router = new VueRouter({
    routes: [
        // dynamic segments start with a colon
        { path: '/', component: App },
        { path: '/register', component: Register,meta:{auth:false} },
        { path: '/login', component: Login,meta:{auth:false} },
        { path: '/dashboard', component: DashBoard,meta:{auth:true} }
    ]
})
require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.prototype.$eventBus = new Vue();
Vue.component('app',App);
Vue.use(VueAxios, axios)
Vue.router=router
Vue.use(VueAuth, {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
});
const app = new Vue({
    router,
    el: '#app'
});
