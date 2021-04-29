require('./bootstrap');

import router from './router'
import store from './store'
import App from './App'

window.Vue = require('vue').default;

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
