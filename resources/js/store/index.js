import Vue from 'vue'
import Vuex from 'vuex'
import month from "./month";
import allEvents from "./allEvents";
import axios from "axios";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        month,
        allEvents
    },
    state: {
        tasks: [],
        birthdays: [],
        events: [],
        reminders: [],
        currentDate: new Date(),
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
        dateInterface(state) {
            let manthArr = [
                'Январь','Февраль','Март','Апрель','Май','Июнь','Июль',
                'Август','Сентябрь','Октябрь','Ноябрь','Декабрь',
            ]
            const month = state.currentDate.getMonth()
            const year = state.currentDate.getFullYear()

            return `${manthArr[month]} ${year}`
        },
        allEventsForDay(state) {
            // console.log(state.tasks)
             return [].concat(state.events, state.birthdays, state.reminders, state.tasks)
        }
    }
})
