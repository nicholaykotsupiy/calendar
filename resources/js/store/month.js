export default {

    state() {
        return {
            isMonth: false,
            monthCalendarMonth: new Date().getMonth(),
            yearCalendarMonth: new Date().getFullYear(),
            titleNavigationCalendarMonth: '',
            monthsCalendarMonth: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
        }
    },

    getters: {

        isMonth(state) {
            return state.isMonth
        },

        monthCalendarMonth(state) {
            return state.monthCalendarMonth
        },

        yearCalendarMonth(state) {
            return state.yearCalendarMonth
        },

        titleNavigationCalendarMonth(state) {
            return state.titleNavigationCalendarMonth
        },

        monthsCalendarMonth(state) {
            return state.monthsCalendarMonth
        },

    },

    mutations: {

        setIsMonth(state, value) {
            state.isMonth = value
        },

        prevMonth(state) {

            state.monthCalendarMonth--
            if (state.monthCalendarMonth < 0) {
                state.monthCalendarMonth = 12
                state.monthCalendarMonth--
                state.yearCalendarMonth--
            }
            state.titleNavigationCalendarMonth = state.monthsCalendarMonth[state.monthCalendarMonth]+' '+state.yearCalendarMonth

        },

        nextMonth(state) {

            state.monthCalendarMonth++
            if (state.monthCalendarMonth > 11) {
                state.monthCalendarMonth = -1
                state.monthCalendarMonth++
                state.yearCalendarMonth++
            }
            state.titleNavigationCalendarMonth = state.monthsCalendarMonth[state.monthCalendarMonth]+' '+state.yearCalendarMonth

        },

        setTitleNavigationCalendarMonth(state, value) {
            state.titleNavigationCalendarMonth = value
        },

        switchToCurrentMonth(state) {
            state.monthCalendarMonth = new Date().getMonth()
            state.yearCalendarMonth = new Date().getFullYear()
            state.titleNavigationCalendarMonth = state.monthsCalendarMonth[new Date().getMonth()]+' '+new Date().getFullYear()
        },

        switchToMonth(state, value) {
            state.monthCalendarMonth = new Date(value).getMonth()
            state.yearCalendarMonth = new Date(value).getFullYear()
            state.titleNavigationCalendarMonth = state.monthsCalendarMonth[new Date(value).getMonth()]+' '+new Date(value).getFullYear()
        }

    },

}
