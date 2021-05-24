require('./bootstrap');

import router from './router'
import store from './store'
import App from './App.vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import  'bootstrap-vue/dist/bootstrap-vue.css'
import moment from 'moment';
import Vue from 'vue';
import vClickOutside from 'v-click-outside';

moment.locale('ru');

window.Vue = require('vue').default;

Vue.prototype.$moment = moment;

Vue.component('top-navigation', require('./components/Navigation/TopNavigationBar/TopNavigation.vue').default);
Vue.component('left-navigation', require('./components/Navigation/LeftNavigationBar/LeftNavigation.vue').default);
Vue.component('the-year', require('./components/Year/TheYear.vue').default);
Vue.component('day-calendar', require('./components/DayCalendar/DayCalendarWrapper').default);
Vue.component('create-events-window', require('./components/Events/Create/CreateEventsWindow').default);
Vue.component('search-calendar', require('./components/ Base/BaseTopBar/Search/SearchCalendar').default);

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(vClickOutside)

window.Vue = require('vue').default;

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
