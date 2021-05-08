export default {

    state() {
        return {

        }
    },

    getters: {


    },

    mutations: {

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


        saveEventToDB(state, newEvent) {

        },
        saveReminderToDB(state, newReminder) {

        },
        saveTaskToDB(state, newTask) {

        },
        saveBirthdayToDB(state, newBirthday) {

        },

    },

    actions: {

        saveEvent({ commit, state }, event) {

            axios.post(`/api/event-store`, event)
                .then(response => {
                    //параметры для модалки с сообщением
                    commit('setTitleModalMessage', '')
                    //this.setTitleModalMessage('')
                    commit('setBodyModalMessage', 'Событие добавлено!')
                    //this.setBodyModalMessage('Событие добавлено!')
                    //вызвать мутацию для загрузки нового мероприятия в состояние
                    let newEvent = (response.data)
                    console.log(response.data)
                    commit('pushEventToState', newEvent)
                    console.log(state.events)
                    //this.pushEventToState(newEvent)
                })
                // .catch(error => {
                //     //console.log(error.response)
                //     //массив, для ошибок валидации на бэке
                //     let errorsArray = []
                //
                //     //вывод ошибки
                //     //если есть ошибка валидации name
                //     if (error.response.data.errors.name) {
                //         for (let i=0; i<error.response.data.errors.name.length; i++) {
                //             errorsArray.push(error.response.data.errors.name[i])
                //         }
                //     }
                //     //если есть ошибка валидации description
                //     if (error.response.data.errors.description) {
                //         for (let i=0; i<error.response.data.errors.description.length; i++) {
                //             errorsArray.push(error.response.data.errors.description[i])
                //         }
                //     }
                //     //если есть ошибка валидации guests
                //     if (error.response.data.errors.guests) {
                //         for (let i=0; i<error.response.data.errors.guests.length; i++) {
                //             errorsArray.push(error.response.data.errors.guests[i])
                //         }
                //     }
                //     //если есть ошибка валидации location
                //     if (error.response.data.errors.location) {
                //         for (let i=0; i<error.response.data.errors.location.length; i++) {
                //             errorsArray.push(error.response.data.errors.location[i])
                //         }
                //     }
                //     //если есть ошибка валидации даты
                //     if (error.response.data.errors.dateStart) {
                //         for (let i=0; i<error.response.data.errors.dateStart.length; i++) {
                //             errorsArray.push(error.response.data.errors.dateStart[i])
                //         }
                //     }
                //     if (error.response.data.errors.dateEnd) {
                //         for (let i=0; i<error.response.data.errors.dateEnd.length; i++) {
                //             errorsArray.push(error.response.data.errors.dateEnd[i])
                //         }
                //     }
                //     //если есть ошибка валидации времени
                //     if (error.response.data.errors.timeStart) {
                //         for (let i=0; i<error.response.data.errors.timeStart.length; i++) {
                //             errorsArray.push(error.response.data.errors.timeStart[i])
                //         }
                //     }
                //     if (error.response.data.errors.timeEnd) {
                //         for (let i=0; i<error.response.data.errors.timeEnd.length; i++) {
                //             errorsArray.push(error.response.data.errors.timeEnd[i])
                //         }
                //     }
                //
                //     commit('setTitleModalMessage', 'Ошибка! Событие не добавлено!')
                //     //this.setTitleModalMessage('Ошибка! Событие не добавлено!')
                //     let message =''
                //     for (let i=0; i<errorsArray.length; i++) {
                //         message += errorsArray[i]+"\n"
                //     }
                //     commit('setBodyModalMessage', message)
                //     //this.setBodyModalMessage(message)
                // })

        },

        saveReminder(state, reminder) {

        },

        saveTask(state, task) {

        },

        saveBirthday(state, birthday) {

        },

    }
}
