require('./bootstrap');

import router from './router'
import store from './store'
import App from './App.vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import  'bootstrap-vue/dist/bootstrap-vue.css'
import moment from 'moment';

moment.locale('ru');

window.Vue = require('vue').default;

Vue.prototype.$moment = moment;

Vue.component('top-navigation', require('./components/Navigation/TopNavigationBar/TopNavigation.vue').default);
Vue.component('left-navigation', require('./components/Navigation/LeftNavigationBar/LeftNavigation.vue').default);
Vue.component('the-year', require('./components/Year/TheYear.vue').default);
Vue.component('day-calendar', require('./components/DayCalendar/DayCalendarWrapper').default);
Vue.component('create-events-window', require('./components/Events/Create/CreateEventsWindow').default);
Vue.component('edit-event-window', require('./components/Events/Edit/EditEventWindow').default);
Vue.component('edit-birthday-window', require('./components/Events/Edit/EditBirthdayWindow').default);
Vue.component('edit-reminder-window', require('./components/Events/Edit/EditReminderWindow').default);
Vue.component('edit-task-window', require('./components/Events/Edit/EditTaskWindow').default);
Vue.component('modal-edit', require('./components/Events/Edit/EditModal').default);
Vue.component('modal-ok', require('./components/ModalMessages/ModalOK').default);
Vue.component('modal-yes-no', require('./components/ModalMessages/ModalYesNo').default);


Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

window.Vue = require('vue').default;

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
