import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
    //    Базовая структура стейта
    // tasks: {
    //     name: '',
    //     description: '',
    //     dateStart: '',
    //     timeStart: '',
    //     dateEnd: '',
    //     timeEnd: '',
    //     allDay: '',
    // },
    // birthdays: {
    //     name: '',
    //     description: '',
    //     date: '',
    //     time: '',
    //     allDay: '',
    //     everyYear: '',
    // },
    // events: {
    //     name: '',
    //     guests: '',
    //     location: '',
    //     description: '',
    //     dateStart: '',
    //     timeStart: '',
    //     dateEnd: '',
    //     timeEnd: '',
    // },
    // reminders: {
    //         name: '',
    //         date: '',
    //         time: '',
    //         toRepeat: ''
    // },
        currentDate: new Date(),
    },
    mutations: {
        prevDate(state) {
            const dayMilliseconds = 24*60*60*1000;
            state.currentDate = new Date(state.currentDate.getTime() - dayMilliseconds)
        },
        nextDate(state) {
            const dayMilliseconds = 24*60*60*1000;
            state.currentDate = new Date(state.currentDate.getTime() + dayMilliseconds)
        },
        switchToCurrentDate(state) {
            state.currentDate = new Date()
        }
    },
    actions: {
    },
    getters: {
        currentDate(state) {
            return state.currentDate
        }
    }
})
