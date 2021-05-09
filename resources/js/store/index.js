import Vue from 'vue'
import Vuex from 'vuex'
import month from "./month";
import saveEvents from "./saveEvents";
import editEvents from "./editEvents";
import deleteEnents from "./deleteEnents";
import day from "./day";

import axios from "axios";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        month,
        saveEvents,
        editEvents,
        deleteEnents,
        day
    },
    state: {
        tasks: [],
        birthdays: [],
        events: [],
        reminders: [],
        currentDate: new Date(),
    },
    mutations: {
        addTasksToState(state, tasks) {
            tasks.forEach(item => {
                if(!state.tasks.find(elem => elem.id === item.id)) {
                    state.tasks.push(item)
                }
            })
        },
        addBirthdaysToState(state, birthdays) {
            birthdays.forEach(item => {
                if(!state.birthdays.find(elem => elem.id === item.id)) {
                    state.birthdays.push(item)
                }
            })
        },
        addEventsToState(state, events) {
            events.forEach(item => {
                if(!state.events.find(elem => elem.id === item.id)) {
                    state.events.push(item)
                }
            })
        },
        addRemindersToState(state, reminders) {
            reminders.forEach(item => {
                if(!state.reminders.find(elem => elem.id === item.id)) {
                    state.reminders.push(item)
                }
            })
        },
    },
    actions: {
        getDataFromServer({ commit, state }, payload) {
            commit('addTasksToState', payload.tasks)
            commit('addBirthdaysToState', payload.birthdays)
            commit('addEventsToState', payload.events)
            commit('addRemindersToState', payload.reminders)
        }
    },
    getters: {
        currentDate(state) {
            return state.currentDate
        },
    }
})
