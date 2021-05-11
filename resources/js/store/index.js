import Vue from 'vue'
import Vuex from 'vuex'
import month from "./month";
import saveEvents from "./saveEvents";
import editEvents from "./editEvents";
import day from "./day";
import createPersistedState from "vuex-persistedstate";
import axios from "axios";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        month,
        saveEvents,
        editEvents,
        day
    },
    state: {
        tasks: [],
        birthdays: [],
        events: [],
        reminders: [],
        currentDate: new Date(),
        user: null,
        access_token: '',
        resetPasswordEmail: ''
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setAccessToken(state, access_token) {
            state.access_token = access_token;
        },
        setResetPasswordEmail(state, resetPasswordEmail) {
            state.resetPasswordEmail = resetPasswordEmail;
        },

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

        deleteEvent(state, itemID) {
            let findItem = state.events.findIndex(item => item.id === itemID)
            state.events.splice(findItem,1)

            axios.delete('api/event-destroy/' + itemID)
                .then(response => console.log(response.data))
        },
        deleteReminder(state, itemID) {
            let findItem = state.reminders.findIndex(item => item.id === itemID)
            state.reminders.splice(findItem,1)

            axios.delete('api/reminder-destroy/' + itemID)
                .then(response => console.log(response.data))
        },
        deleteBirthday(state, itemID) {
            let findItem = state.birthdays.findIndex(item => item.id === itemID)
            state.birthdays.splice(findItem,1)

            axios.delete('api/birthday-destroy/' + itemID)
                .then(response => console.log(response.data))
        },
        deleteTask(state, itemID) {
            let findItem = state.tasks.findIndex(item => item.id === itemID)
            state.tasks.splice(findItem,1)

            axios.delete('api/task-destroy/' + itemID)
                .then(response => console.log(response.data))
        },

        editEvent(state, payload) {
            let findItem = state.events.findIndex(item => item.id === payload.id)
            axios.put('/api/event-update', payload)
                .then(response => {
                    state.events.splice(findItem,1, response.data)
                })
        },
        editTask(state, payload) {
            let findItem = state.tasks.findIndex(item => item.id === payload.id)
            axios.put('/api/task-update', payload)
                .then(response => {
                    state.tasks.splice(findItem,1, response.data)
                })
        },
        editReminder(state, payload) {
            let findItem = state.reminders.findIndex(item => item.id === payload.id)
            axios.put('/api/reminder-update', payload)
                .then(response => {

                    state.reminders.splice(findItem,1, response.data)
                })
        },
        editBirthday(state, payload) {
            let findItem = state.birthdays.findIndex(item => item.id === payload.id)
            axios.put('/api/birthday-update', payload)
                .then(response => {
                    state.birthdays.splice(findItem,1, response.data)
                })
        },
    },
    actions: {
        saveUserFromServer({commit}, user) {
            console.log(user);
            commit('setUser', user);
        },
        saveAccessFromServer({commit}, access_token) {
            commit('setAccessToken', access_token);
        },
        saveResetPasswordEmail({commit}, resetPasswordEmail) {
            commit('setResetPasswordEmail', resetPasswordEmail);
        },

        getDataFromServer({ commit, state }, payload) {
            commit('addTasksToState', payload.tasks)
            commit('addBirthdaysToState', payload.birthdays)
            commit('addEventsToState', payload.events)
            commit('addRemindersToState', payload.reminders)
        },

        deleteItem({commit}, payload) {
            switch(payload.type) {
                case 'event':
                    commit('deleteEvent', payload.id)
                    break
                case 'reminder':
                    commit('deleteReminder', payload.id)
                    break
                case 'birthday':
                    commit('deleteBirthday', payload.id)
                    break
                case 'task':
                    commit('deleteTask', payload.id)
                    break
            }
        },

        editItem({commit}, payload) {
            switch(payload.type) {
                case 'task':
                    commit('editTask', payload)
                    break
                case 'reminder':
                    commit('editReminder', payload)
                    break
                case 'birthday':
                    commit('editBirthday', payload)
                    break
                case 'event':
                    commit('editEvent', payload)
                    break
            }
        }
    },
    getters: {
        currentDate(state) {
            return state.currentDate
        },
        dateInterface(state, getters) {
            let manthArr = [
                'Январь','Февраль','Март','Апрель','Май','Июнь','Июль',
                'Август','Сентябрь','Октябрь','Ноябрь','Декабрь',
            ]

            const month = state.currentDate.getMonth()
            const year = state.currentDate.getFullYear()

            return `${manthArr[month]} ${year}`
        },
        allEventsForDay(state, getters) {
            return [].concat(state.events, state.birthdays, state.reminders, state.tasks)
        },

        user(state) {
            return state.user;
        },
        access_token(state) {
            return state.access_token;
        },
        resetPasswordEmail(state) {
            return state.resetPasswordEmail;
        },
    },
    plugins: [createPersistedState({paths: ['user', 'access_token', 'resetPasswordEmail']})],
})
