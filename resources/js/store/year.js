export default {

    state() {
        return {
            isYear: false,
            yearCalendarYear: new Date().getFullYear(),
            titleNavigationCalendarYear: '',
        }
    },

    getters: {

        isYear(state) {
            return state.isYear
        },

        monthCalendarYear(state) {
            return state.monthCalendarYear
        },

        yearCalendarYear(state) {
            return state.yearCalendarYear
        },

        titleNavigationCalendarYear(state) {
            return state.titleNavigationCalendarYear
        },

    },

    mutations: {

        setIsYear(state, value) {
            state.isYear = value
        },

        prevYear(state) {
            state.yearCalendarYear--
            state.titleNavigationCalendarYear = state.yearCalendarYear + ' г'
        },

        nextYear(state) {
            state.yearCalendarYear++
            state.titleNavigationCalendarYear = state.yearCalendarYear + ' г'
        },

        setTitleNavigationCalendarYear(state, value) {
            state.titleNavigationCalendarYear = value
        },

        switchToCurrentYear(state) {
            state.yearCalendarYear = new Date().getFullYear()
            state.titleNavigationCalendarYear = new Date().getFullYear() + ' г'
        },

        setYearCalendarYear(state, payload) {
            state.yearCalendarYear = payload
        }

    },

}
