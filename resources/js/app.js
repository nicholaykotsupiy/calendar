require('./bootstrap');

import router from './router'
import store from './store'
import App from './App.vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import  'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = require('vue').default;

Vue.component('top-navigation', require('./components/Navigation/TopNavigationBar/TopNavigation.vue').default);
Vue.component('left-navigation', require('./components/Navigation/LeftNavigationBar/LeftNavigation.vue').default);
Vue.component('the-year', require('./components/Year/TheYear.vue').default);
Vue.component('day-calendar', require('./components/DayCalendar/DayCalendarWrapper').default);
Vue.component('create-event', require('./components/CreatureEventsWindows/CreateEvent').default);
Vue.component('create-reminder', require('./components/CreatureEventsWindows/CreateReminder.vue').default);
Vue.component('create-reminder', require('./components/CreatureEventsWindows/CreateTask.vue').default);

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

window.Vue = require('vue').default;

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
