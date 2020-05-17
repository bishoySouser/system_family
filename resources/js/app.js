
require('./bootstrap');

window.Vue = require('vue');
import Axios from 'axios';
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

  
  axios.interceptors.response.use(function (response){
      return response;
  },function (error){
    if(error.response.status === 401){
        setTimeout(function(){
            store.commit('logout')
            router.push('/login')
        },3000)
        
    }
    return Promise.reject(error)
  });





import App from './App.vue'


new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')


