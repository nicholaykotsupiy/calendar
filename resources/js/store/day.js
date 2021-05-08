export default {
    state() {
    },
    mutations: {
        prevDateToDayCalendar(state) {
            state.currentDate = new Date(state.currentDate.getTime() - 24*60*60*1000)
        },
        nextDateToDayCalendar(state) {
            state.currentDate = new Date(state.currentDate.getTime() + 24*60*60*1000)
        },
        currentDateToDayCalendar(state) {
            state.currentDate = new Date()
        },
    },
    actions: {
    },
    getters: {
        dateInterface(state, getters, rootState) {
            let manthArr = [
                'Январь','Февраль','Март','Апрель','Май','Июнь','Июль',
                'Август','Сентябрь','Октябрь','Ноябрь','Декабрь',
            ]
            const month = rootState.currentDate.getMonth()
            const year = rootState.currentDate.getFullYear()

            return `${manthArr[month]} ${year}`
        },
        allEventsForDay(state, getters, rootState) {
            return [].concat(rootState.events, rootState.birthdays, rootState.reminders, rootState.tasks)
        }
    },
}
