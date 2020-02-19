
require('./bootstrap');

window.Vue = require('vue');

// vue-router
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

import routes from './routes'

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.secure)) {
    if(localStorage.getItem('token') == null) {
        console.log('no token')
        next({
            path: '/login'
        })
    }else{
        next()
    }
  } else {
       next()
  }
})





import App from './App.vue'

new Vue({
    router,
    render: h => h(App)
}).$mount('#app')


