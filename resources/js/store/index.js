import Vue from 'vue'
import Vuex from 'vuex'
import month from "./month";
import birthday from "./birthday";
import allEvents from "./allEvents";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        month,
        birthday,
        allEvents
    },
    state: {
    //    Базовая структура стейта'
        tasks: [
            {
                id: 1,
                type: 'task',
                name: 'Новая задачка',
                description: 'Описание задачи',
                dateStart: '5/7/2021', // currentDate
                timeStart: '2:30',
                dateEnd: '5/7/2021',
                timeEnd: '12:00',
                allDay: false,
                user_id: 1,
                end: 2,
            },
        ],
        birthdays: [
            {
                id: 1,
                type: 'birthday',
                name: 'День рожденья',
                description: '',
                dateStart: '5/7/2021', // currentDate
                timeStart: '1:00',
                allDay: false,
                everyYear: false,
                user_id: 1,
                end: 1
            },
        ],
        events: [
            {
                id: 1,
                name: 'Крутое мероприятие',
                type: 'event',
                guests: ['qwe'],
                location: 'Kramatorsk Park',
                description: '',
                dateStart: '5/6/2021', // currentDate
                dateEnd: '5/7/2021',
                timeStart: '4:30',
                timeEnd: '5:00',
                user_id: 1,
                end: 1
            },
        ],
        reminders: [
            {
                id: 1,
                type: 'reminder',
                name: 'Напоминание на экзамен',
                dateStart: '5/6/2021', // currentDate
                timeStart: '00:00',
                toRepeat: false,
                user_id: 1,
                end: 1
            },
            {
                id: 2,
                type: 'reminder',
                name: 'Напоминание на экзамен',
                dateStart: '5/6/2021', // currentDate
                timeStart: '00:00',
                toRepeat: false,
                user_id: 1,
                end: 1
            },
        ],
        currentDate: new Date(),
    },
    mutations: {
        prevDateToDayCalendar(state) {
            const dayMilliseconds = 24*60*60*1000;
            state.currentDate = new Date(state.currentDate.getTime() - dayMilliseconds)
        },
        nextDateToDayCalendar(state) {
            const dayMilliseconds = 24*60*60*1000;
            state.currentDate = new Date(state.currentDate.getTime() + dayMilliseconds)
        },
        currentDateToDayCalendar(state) {
            state.currentDate = new Date()
        }
    },
    actions: {
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
             return [].concat(state.events, state.birthdays, state.reminders, state.tasks)
        }
    }
})
