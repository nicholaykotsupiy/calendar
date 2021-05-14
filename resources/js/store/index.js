import Vue from 'vue'
import Vuex from 'vuex'
import month from "./month";
import day from "./day";
import createPersistedState from "vuex-persistedstate";

import axios from "axios";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        month,
        day
    },
    state: {
        holidays: {},
        tasks: [],
        birthdays: [],
        events: [],
        reminders: [],
        currentDate: new Date(),
        access_token: '',
        resetPasswordEmail: '',

        isCreateEventWindowVisible: true,
        isCreateReminderWindowVisible: false,
        isCreateTaskWindowVisible: false,
        isCreateBirthdayWindowVisible: false,

        titleModalMessage: '',
        bodyModalMessage: '',
        // bodyModalMessage: 'Событие добавлено!',

        isVisibleEditEventWindow: false,
        isVisibleEditReminderWindow: false,
        isVisibleEditTaskWindow: false,
        isVisibleEditBirthdayWindow: false,

        valueDeleteIdEvent: null,
        valueDeleteTypeEvent: null,
        eventEdit: {},
        key: 0,
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


        swichToDate(state, payload) {
            state.currentDate = new Date(payload)
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

        pushEventToState(state, newEvent) {
            state.events.push(newEvent)
        },

        pushReminderToState(state, newReminder) {
            state.reminders.push(newReminder)
        },

        pushTaskToState(state, newTask) {
            state.tasks.push(newTask)
        },

        pushBirthdayToState(state, newBirthday) {
            state.birthdays.push(newBirthday)
        },

        addHolidaysToState(state, payload) {
            state.holidays = payload
        },

        deleteEvent(state, itemID) {
            let findItem = state.events.findIndex(item => item.id === itemID)
            state.events.splice(findItem,1)

            axios.delete('api/event-destroy/' + itemID)
                .then(response => {
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Событие удалено!'
                    //console.log(response.data)
                })
                .catch(error => {
                    //сообщение о неуспешном удалении
                    state.titleModalMessage = error.response.data
                    state.bodyModalMessage = 'Событие не удалось удалить!'
                })

        },

        deleteReminder(state, itemID) {
            let findItem = state.reminders.findIndex(item => item.id === itemID)
            state.reminders.splice(findItem,1)

            axios.delete('api/reminder-destroy/' + itemID)
                .then(response => {
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Событие удалено!'
                    //console.log(response.data)
                })
                .catch(error => {
                    //сообщение о неуспешном удалении
                    state.titleModalMessage = error.response.data
                    state.bodyModalMessage = 'Событие не удалось удалить!'
                })
        },

        deleteBirthday(state, itemID) {
            let findItem = state.birthdays.findIndex(item => item.id === itemID)
            state.birthdays.splice(findItem,1)

            axios.delete('api/birthday-destroy/' + itemID)
                .then(response => {
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Событие удалено!'
                    //console.log(response.data)
                })
                .catch(error => {
                    //сообщение о неуспешном удалении
                    state.titleModalMessage = error.response.data
                    state.bodyModalMessage = 'Событие не удалось удалить!'
                })
        },

        deleteTask(state, itemID) {
            let findItem = state.tasks.findIndex(item => item.id === itemID)
            state.tasks.splice(findItem,1)

            axios.delete('api/task-destroy/' + itemID)
                .then(response => {
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Событие удалено!'
                    //console.log(response.data)
                })
                .catch(error => {
                    //сообщение о неуспешном удалении
                    state.titleModalMessage = error.response.data
                    state.bodyModalMessage = 'Событие не удалось удалить!'
                })
        },

        editEvent(state, payload) {
            let findItem = state.events.findIndex(item => item.id === payload.event.id)
            axios.put('/api/event-update', payload)
                .then(response => {
                    state.events.splice(findItem,1, response.data)
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Событие изменено!'
                })
                .catch(error => {
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Ошибка! Событие не удалось изменить!'
                })
        },

        editTask(state, payload) {
            let findItem = state.tasks.findIndex(item => item.id === payload.task.id)
            axios.put('/api/task-update', payload)
                .then(response => {
                    // console.log(response.data)
                    state.tasks.splice(findItem,1, response.data)
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Событие изменено!'
                })
                .catch(error => {
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Ошибка! Событие не удалось изменить!'
                })
        },

        editReminder(state, payload) {
            let findItem = state.reminders.findIndex(item => item.id === payload.reminder.id)
            axios.put('/api/reminder-update', payload)
                .then(response => {
                    state.reminders.splice(findItem,1, response.data)
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Событие изменено!'
                })
                .catch(error => {
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Ошибка! Событие не удалось изменить!'
                })
        },

        editBirthday(state, payload) {
            let findItem = state.birthdays.findIndex(item => item.id === payload.birthday.id)
            axios.put('/api/birthday-update', payload)
                .then(response => {
                    state.birthdays.splice(findItem,1, response.data)
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Событие изменено!'
                })
                .catch(error => {
                    state.titleModalMessage = ''
                    state.bodyModalMessage = 'Ошибка! Событие не удалось изменить!'
                })
        },

        updateEventColor(state, payload) {
            state.events.map(item => {
                item.main_color = payload.main_color
                item.bg_color = payload.bg_color
            })
        },
        updateTaskColor(state, payload) {
            state.tasks.map(item => {
                item.main_color = payload.main_color
                item.bg_color = payload.bg_color
            })
        },
        updateReminderColor(state, payload) {
            state.reminders.map(item => {
                item.main_color = payload.main_color
                item.bg_color = payload.bg_color
            })
        },
        updateBirthdayColor(state, payload) {
            state.birthdays.map(item => {
                item.main_color = payload.main_color
                item.bg_color = payload.bg_color
            })
        },

        setIsCreateEventWindowVisible(state, value) {
            state.isCreateEventWindowVisible = value
        },
        setIsCreateReminderWindowVisible(state, value) {
            state.isCreateReminderWindowVisible = value
        },
        setIsCreateTaskWindowVisible(state, value) {
            state.isCreateTaskWindowVisible = value
        },
        setIsCreateBirthdayWindowVisible(state, value) {
            state.isCreateBirthdayWindowVisible = value
        },

        showCreateEventWindow(state) {
            state.isCreateEventWindowVisible = true
            state.isCreateReminderWindowVisible = false
            state.isCreateTaskWindowVisible = false
            state.isCreateBirthdayWindowVisible = false
        },

        setTitleModalMessage(state, value) {
            state.titleModalMessage = value
        },
        setBodyModalMessage(state, value) {
            state.bodyModalMessage = value
        },

        setIsVisibleEditEventWindow(state, value) {
            state.isVisibleEditEventWindow = value
        },
        setIsVisibleEditReminderWindow(state, value) {
            state.isVisibleEditReminderWindow = value
        },
        setIsVisibleEditTaskWindow(state, value) {
            state.isVisibleEditTaskWindow = value
        },
        setIsVisibleEditBirthdayWindow(state, value) {
            state.isVisibleEditBirthdayWindow = value
        },

        setValueDeleteIdEvent(state, value) {
            state.valueDeleteIdEvent = value
        },
        setValueDeleteTypeEvent(state, value) {
            state.valueDeleteTypeEvent = value
        },

        setEventEdit(state, payload) {
            state.eventEdit = payload
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
        },

        updateColors({commit}, payload) {
            switch(payload.type) {
                case 'task':
                    axios.post('/api/update-colors', payload)
                        .then(r => commit('updateTaskColor', payload))
                    break
                case 'reminder':
                    axios.post('/api/update-colors', payload)
                        .then(r => commit('updateReminderColor', payload))
                    break
                case 'birthday':
                    axios.post('/api/update-colors', payload)
                        .then(r => commit('updateBirthdayColor', payload))
                    break
                case 'event':
                    axios.post('/api/update-colors', payload)
                        .then(r => commit('updateEventColor', payload))
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

        holidays(state) {
            return state.holidays
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
        isCreateEventWindowVisible(state) {
            return state.isCreateEventWindowVisible
        },
        isCreateReminderWindowVisible(state) {
            return state.isCreateReminderWindowVisible
        },
        isCreateTaskWindowVisible(state) {
            return state.isCreateTaskWindowVisible
        },
        isCreateBirthdayWindowVisible(state) {
            return state.isCreateBirthdayWindowVisible
        },

        titleModalMessage(state) {
            return state.titleModalMessage
        },
        bodyModalMessage(state) {
            return state.bodyModalMessage
        },

        isVisibleEditEventWindow(state) {
            return state.isVisibleEditEventWindow
        },
        isVisibleEditReminderWindow(state) {
            return state.isVisibleEditReminderWindow
        },
        isVisibleEditTaskWindow(state) {
            return state.isVisibleEditTaskWindow
        },
        isVisibleEditBirthdayWindow(state) {
            return state.isVisibleEditBirthdayWindow
        },

        valueDeleteIdEvent(state) {
            return state.valueDeleteIdEvent
        },
        valueDeleteTypeEvent(state) {
            return state.valueDeleteTypeEvent
        },

        eventEdit(state) {
            return status.eventEdit
        }
    },
    plugins: [createPersistedState({paths: ['access_token', 'resetPasswordEmail']})],
})
