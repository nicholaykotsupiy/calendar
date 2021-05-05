import Vue from 'vue'
import Vuex from 'vuex'
import month from "./month";

Vue.use(Vuex)

export default new Vuex.Store({

    modules: {
        month,
    },

    state: {

        tasks: [],
        birthdays: [],
        events: [],
        reminders: [],

    //    Базовая структура стейта
    // tasks: {
    //     id: '' ,
    //     name: '',
    //     description: '',
    //     dateStart: '',
    //     timeStart: '',
    //     dateEnd: '',
    //     timeEnd: '',
    //     allDay: '',
    //     user_id: '',
    // },
    // birthdays: {
    //     id: '' ,
    //     name: '',
    //     description: '',
    //     date: '',
    //     time: '',
    //     allDay: '',
    //     everyYear: '',
    //     user_id: '',
    // },
    // events: {
    //     id: '' ,
    //     name: '',
    //     guests: '',
    //     location: '',
    //     description: '',
    //     dateStart: '',
    //     timeStart: '',
    //     dateEnd: '',
    //     timeEnd: '',
    //     user_id: '',
    // },
    // reminders: {
    //     id: '' ,
    //     name: '',
    //     date: '',
    //     time: '',
    //     toRepeat: '',
    //     user_id: '',
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
