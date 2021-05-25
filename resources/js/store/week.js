import moment from 'moment';
moment.locale('ru');
window.Vue = require('vue').default;

export default {

    state() {
        return {
            isWeek: false,
            weekCalendarWeek: moment().week(),
            monthCalendarWeek: moment().month(),
            yearCalendarWeek: moment().year(),
            titleNavigationCalendarWeek: '',
            monthsCalendarWeek: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
        }
    },

    getters: {

        isWeek(state) {
            return state.isWeek
        },
        weekCalendarWeek(state) {
            return state.weekCalendarWeek
        },
        monthCalendarWeek(state) {
            return state.monthCalendarWeek
        },

        yearCalendarWeek(state) {
            return state.yearCalendarWeek
        },
        titleNavigationCalendarWeek(state) {
            return state.titleNavigationCalendarWeek
        },
        // monthsCalendarMonth(state) {
        //     return state.monthsCalendarMonth
        // },
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
            state.yearCalendarWeek = moment().year();

            const date = (1 + (state.weekCalendarWeek - 1) * 7);
            const monthOfWeekNumber = new Date(state.yearCalendarWeek, 0, date).getMonth();

            state.titleNavigationCalendarWeek = state.monthsCalendarWeek[monthOfWeekNumber] + ' ' + state.yearCalendarWeek;
        },
        prevWeek(state) {
            state.weekCalendarWeek -= 1;

            if (state.weekCalendarWeek < 0) {
                state.yearCalendarWeek -= 1;
                state.weekCalendarWeek = 52;
            }

            const date = (1 + (state.weekCalendarWeek - 1) * 7);
            const monthOfWeekNumber = new Date(state.yearCalendarWeek, 0, date).getMonth();

            state.titleNavigationCalendarWeek = state.monthsCalendarWeek[monthOfWeekNumber] + ' ' + state.yearCalendarWeek;
        },
        nextWeek(state) {
            state.weekCalendarWeek += 1;

            if (state.weekCalendarWeek > 52) {
                state.yearCalendarWeek += 1;
                state.weekCalendarWeek = 1;
            }

            const date = (1 + (state.weekCalendarWeek - 1) * 7);
            const monthOfWeekNumber = new Date(state.yearCalendarWeek, 0, date).getMonth();

            state.titleNavigationCalendarWeek = state.monthsCalendarWeek[monthOfWeekNumber] + ' ' + state.yearCalendarWeek;
        },
    },
}
