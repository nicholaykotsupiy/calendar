require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('top-navigation', require('./components/Navigation/TopNavigationBar/TopNavigation.vue').default);
Vue.component('left-navigation', require('./components/Navigation/LeftNavigationBar/LeftNavigation.vue').default);
Vue.component('the-year', require('./components/Calendar/Year/TheYear.vue').default);

const app = new Vue({
    el: '#app',
});