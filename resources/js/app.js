
require('./bootstrap');

window.Vue = require('vue');

// vue-router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
//vuex
import Vuex from "vuex";
import storeData from "./store.js";
//vue-spinners
import { VueSpinners } from '@saeris/vue-spinners'
Vue.use(VueSpinners)

const store = new Vuex.Store(storeData);
const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
})

import routes from './routes'

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        //If path without requiresAuth push login
        if(!store.state.isLoggedIn){
            next({
                path: "/login"
            })
        } else{
            next();
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (!store.state.isLoggedIn) {
            next();
        } else {
        //console.log("no token");
            next({
                path: "/home"
            });
        }
    } else {
        next();
    }
  })





import App from './App.vue'

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')


