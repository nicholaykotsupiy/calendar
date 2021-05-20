import moment from 'moment';
moment.locale('ru');
window.Vue = require('vue').default;

export default {

    state() {
        return {
            isWeek: false,
            weekCalendarWeek: moment().week(),
            yearCalendarWeek: moment().year(),
            titleNavigationCalendarWeek: '',
            monthsCalendarMonth: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
        }
    },

    getters: {

        isWeek(state) {
            return state.isWeek
        },
        weekCalendarWeek(state) {
            return state.weekCalendarWeek
        },
        monthCalendarMonth(state) {
            return state.monthCalendarMonth
        },

        yearCalendarWeek(state) {
            return state.yearCalendarWeek
        },
        titleNavigationCalendarWeek(state) {
            return state.titleNavigationCalendarWeek
        },
        monthsCalendarMonth(state) {
            return state.monthsCalendarMonth
        },
    },

    mutations: {
        setIsWeek(state, value) {
            state.isWeek = value
        },
        setTitleNavigationCalendarWeek(state, value) {
            state.titleNavigationCalendarWeek = value
        },
        switchToCurrentWeek(state) {
            state.weekCalendarWeek = moment().week();
        },
        prevWeek(state) {
            state.weekCalendarWeek -= 1;

            if (state.weekCalendarWeek < 0) {
                state.yearCalendarWeek -= 1;
                state.weekCalendarWeek = 52;
            }
        },
        nextWeek(state) {
            state.weekCalendarWeek += 1;

            if (state.weekCalendarWeek > 52) {
                state.yearCalendarWeek += 1;
                state.weekCalendarWeek = 1;
            }
        },
    },
}
