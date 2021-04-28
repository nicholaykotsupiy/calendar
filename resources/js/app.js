require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import  'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('day-calendar', require('./components/DayCalendar/DayCalendarWrapper').default);

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const app = new Vue({
    el: '#app',
});
