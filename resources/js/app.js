/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Bootstrap from './bootstrap.js';

import Vue from 'vue'
import VueRouter from 'vue-router'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.use(VueRouter)

import App from './components/App'
import Dashboard from './components/Dashboard'
import Account from './components/Account'
import Profile from './components/Profile'
import ShippingAddress from './components/ShippingAddress'
import BillingAddress from './components/BillingAddress'
import Orders from './components/Orders'
import Admin from './components/Admin'
import Products from './components/Products'
import Product from './components/Product'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
    { path: '/', component: Dashboard },
    { path: '/account', component: Account, 
        children: [ 
            { path: 'profile', component: Profile, },
            { path: 'orders', component: Orders, },
            { path: 'shipping-address', component: ShippingAddress, },
            { path: 'billing-address', component: BillingAddress, }
        ] 
    },
    { path: '/users', component: Admin, meta: { requiresAuth: true, adminAuth: true} },
    { path: '/products', component: Products, meta: { requiresAuth: true, producerAuth: true}},
    { path: '/product', component: Product}
  ]
  
const router = new VueRouter({
    routes, // short for `routes: routes`
   // mode: 'history',

})

router.beforeEach((to, from, next) => {
    if(to.meta.requiresAuth) {
            const authUser = JSON.parse(window.localStorage.getItem('nsUser'));
            if (to.meta.adminAuth) {
                if(authUser.role === 'admin') {
                    next();
                } else {
                        next('/')
                }
            }
            if (to.meta.producerAuth) {
                if(authUser.role === 'producer') {
                    next();
                } else {
                        next('/')
                }
            }
    } else {
        next();
    }
});


// inject a handler for `myOption` custom option
Vue.mixin({
    data: function () {
            return {
                get web_url() {
                   // return "https://tokeup.ca/";
                    return "http://localhost:8000/";
        }
    }
}
    
})

const app = new Vue({
    el: '#app',
    components: { App },
    router
});

