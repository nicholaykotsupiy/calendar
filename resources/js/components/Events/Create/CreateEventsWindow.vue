<template>
        <transition name="window-fade">
            <div class="content-create-event-window">
                <div class="backdrop-create-event-window">
                    <div class="create-event-window">
                        <div class="create-event">
                            <div class="row justify-content-between py-2 header-create-event">
                                <div class="col-md-11">
                                    <div class="row text-center y-2">
                                        <template v-if="isCreateEventWindowVisible">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary" @click="showCreateEventWindow">
                                                    Мероприятие
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateReminderWindow">
                                                    Напоминание
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateTaskWindow">
                                                    Задача
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateBirthdayWindow">
                                                    День рождения
                                                </button>
                                            </div>
                                        </template>
                                        <template v-if="isCreateReminderWindowVisible">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateEventWindow">
                                                    Мероприятие
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary" @click="showCreateReminderWindow">
                                                    Напоминание
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateTaskWindow">
                                                    Задача
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateBirthdayWindow">
                                                    День рождения
                                                </button>
                                            </div>
                                        </template>
                                        <template v-if="isCreateTaskWindowVisible">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateEventWindow">
                                                    Мероприятие
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateReminderWindow">
                                                    Напоминание
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary" @click="showCreateTaskWindow">
                                                    Задача
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateBirthdayWindow">
                                                    День рождения
                                                </button>
                                            </div>
                                        </template>
                                        <template v-if="isCreateBirthdayWindowVisible">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateEventWindow">
                                                    Мероприятие
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateReminderWindow">
                                                    Напоминание
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-primary" @click="showCreateTaskWindow">
                                                    Задача
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary" @click="showCreateBirthdayWindow">
                                                    День рождения
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <button type="button" class="col-md-1 close my-close" aria-label="Close" @click="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <!-- Модальное окно для сообщений-->
                            <modal-ok></modal-ok>

                            <!--        Компонент - модальное окно для создания Мероприятия-->
                            <the-event
                                v-show="isCreateEventWindowVisible"
                                @close="closeCreateEventWindow"
                                @saveEvent="saveEvent"
                            >
                            </the-event>

                            <!--        Компонент - модальное окно для создания Напоминания-->
                            <the-reminder
                                v-show="isCreateReminderWindowVisible"
                                @close="closeCreateReminderWindow"
                                @saveEvent="saveReminder"
                            >
                            </the-reminder>

                            <!--        Компонент - модальное окно для создания Задачи -->
                            <the-task
                                v-show="isCreateTaskWindowVisible"
                                @close="closeCreateTaskWindow"
                                @saveEvent="saveTask"
                            >
                            </the-task>

                            <!--        Компонент - модальное окно для создания Дня рождения -->
                            <the-birthday
                                v-show="isCreateBirthdayWindowVisible"
                                @close="closeCreateBirthdayWindow"
                                @saveEvent="saveBirthday"
                            >
                            </the-birthday>

                        </div>
                    </div>
                </div>
            </div>
        </transition>
</template>

<script>
import TheEvent from "../TheEvent";
import TheReminder from "../TheReminder";
import TheTask from "../TheTask";
import TheBirthday from "../TheBirthday";
import { mapGetters, mapMutations } from 'vuex'

export default {

    name: "CreateEvents",

    components: {
        TheEvent,
        TheReminder,
        TheTask,
        TheBirthday
    },

    computed: {

        isCreateEventWindowVisible() {
            return this.isCreateEventWindowVisible
        },
        isCreateReminderWindowVisible() {
            return this.isCreateReminderWindowVisible
        },
        isCreateTaskWindowVisible() {
            return this.isCreateTaskWindowVisible
        },
        isCreateBirthdayWindowVisible() {
            return this.isCreateBirthdayWindowVisible
        },

        ...mapGetters([
            'isCreateEventWindowVisible',
            'isCreateReminderWindowVisible',
            'isCreateTaskWindowVisible',
            'isCreateBirthdayWindowVisible',
        ])
    },

    methods: {

        ...mapMutations([
            'setTitleModalMessage',
            'setBodyModalMessage',
            'setIsCreateEventWindowVisible',
            'setIsCreateReminderWindowVisible',
            'setIsCreateTaskWindowVisible',
            'setIsCreateBirthdayWindowVisible',
            'showCreateEventWindow',
            'pushEventToState',
            'pushReminderToState',
            'pushTaskToState',
            'pushBirthdayToState',
        ]),

        close() {
            this.$emit('closeWrap');
        },

        showCreateReminderWindow() {
            this.setIsCreateReminderWindowVisible(true);
            this.setIsCreateEventWindowVisible(false);
            this.setIsCreateTaskWindowVisible(false);
            this.setIsCreateBirthdayWindowVisible(false);
        },
        showCreateTaskWindow() {
            this.setIsCreateTaskWindowVisible(true);
            this.setIsCreateEventWindowVisible(false);
            this.setIsCreateReminderWindowVisible(false);
            this.setIsCreateBirthdayWindowVisible(false);
        },
        showCreateBirthdayWindow() {
            this.setIsCreateBirthdayWindowVisible(true);
            this.setIsCreateEventWindowVisible(false);
            this.setIsCreateReminderWindowVisible(false);
            this.setIsCreateTaskWindowVisible(false);
        },

        closeCreateEventWindow() {
            this.close();
            this.showCreateEventWindow()
        },
        closeCreateReminderWindow() {
            this.close();
            this.showCreateEventWindow()
        },
        closeCreateTaskWindow() {
            this.close();
            this.showCreateEventWindow()
        },
        closeCreateBirthdayWindow() {
            this.close();
            this.showCreateEventWindow()
        },

        saveEvent(event) {

            axios.post(`/api/event-store`, event)
                .then(response => {
                    //параметры для модалки с сообщением
                    this.setTitleModalMessage('')
                    this.setBodyModalMessage('Событие добавлено!')
                    //вызвать мутацию для загрузки нового мероприятия в состояние
                    let newEvent = (response.data)
                    this.pushEventToState(newEvent)
                })
                .catch(error => {
                    //массив, для ошибок валидации на бэке
                    let errorsArray = []

                    //вывод ошибки
                    //если есть ошибка валидации name
                    if (error.response.data.errors.name) {
                        for (let i=0; i<error.response.data.errors.name.length; i++) {
                            errorsArray.push(error.response.data.errors.name[i])
                        }
                    }
                    //если есть ошибка валидации description
                    if (error.response.data.errors.description) {
                        for (let i=0; i<error.response.data.errors.description.length; i++) {
                            errorsArray.push(error.response.data.errors.description[i])
                        }
                    }
                    //если есть ошибка валидации guests
                    if (error.response.data.errors.guests) {
                        for (let i=0; i<error.response.data.errors.guests.length; i++) {
                            errorsArray.push(error.response.data.errors.guests[i])
                        }
                    }
                    //если есть ошибка валидации location
                    if (error.response.data.errors.location) {
                        for (let i=0; i<error.response.data.errors.location.length; i++) {
                            errorsArray.push(error.response.data.errors.location[i])
                        }
                    }
                    //если есть ошибка валидации даты
                    if (error.response.data.errors.dateStart) {
                        for (let i=0; i<error.response.data.errors.dateStart.length; i++) {
                            errorsArray.push(error.response.data.errors.dateStart[i])
                        }
                    }
                    if (error.response.data.errors.dateEnd) {
                        for (let i=0; i<error.response.data.errors.dateEnd.length; i++) {
                            errorsArray.push(error.response.data.errors.dateEnd[i])
                        }
                    }
                    //если есть ошибка валидации времени
                    if (error.response.data.errors.timeStart) {
                        for (let i=0; i<error.response.data.errors.timeStart.length; i++) {
                            errorsArray.push(error.response.data.errors.timeStart[i])
                        }
                    }
                    if (error.response.data.errors.timeEnd) {
                        for (let i=0; i<error.response.data.errors.timeEnd.length; i++) {
                            errorsArray.push(error.response.data.errors.timeEnd[i])
                        }
                    }

                    this.setTitleModalMessage('Ошибка! Событие не добавлено!')
                    let message =''
                    for (let i=0; i<errorsArray.length; i++) {
                        message += errorsArray[i]+"\n"
                    }
                    this.setBodyModalMessage(message)
                })

            // закрыть окно
            this.close()
            this.showCreateEventWindow()
        },

        saveReminder(reminder) {

            axios.post(`/api/reminder-store`, reminder)
                .then(response => {
                    //параметры для модалки с сообщением
                    this.setTitleModalMessage('')
                    this.setBodyModalMessage('Событие добавлено!')
                    //вызвать мутацию для загрузки нового напоминания в состояние
                    let newReminder = (response.data)
                    this.pushReminderToState(newReminder)
                })
                .catch(error => {
                    //массив, для ошибок валидации на бэке
                    let errorsArray = []

                    //вывод ошибки
                    //если есть ошибка валидации name
                    if (error.response.data.errors.name) {
                        for (let i=0; i<error.response.data.errors.name.length; i++) {
                            errorsArray.push(error.response.data.errors.name[i])
                        }
                    }
                    //если есть ошибка валидации даты
                    if (error.response.data.errors.date) {
                        for (let i=0; i<error.response.data.errors.date.length; i++) {
                            errorsArray.push(error.response.data.errors.date[i])
                        }
                    }
                    //если есть ошибка валидации времени
                    if (error.response.data.errors.time) {
                        for (let i=0; i<error.response.data.errors.time.length; i++) {
                            errorsArray.push(error.response.data.errors.time[i])
                        }
                    }
                    //если есть ошибка валидации toRepeat
                    if (error.response.data.errors.toRepeat) {
                        for (let i=0; i<error.response.data.errors.toRepeat.length; i++) {
                            errorsArray.push(error.response.data.errors.toRepeat[i])
                        }
                    }

                    this.setTitleModalMessage('Ошибка! Событие не добавлено!')
                    let message =''
                    for (let i=0; i<errorsArray.length; i++) {
                        message += errorsArray[i]+"\n"
                    }
                    this.setBodyModalMessage(message)
                });

            // закрыть окно
            this.close();
            this.showCreateEventWindow()

        },

        saveTask(task) {

            axios.post(`/api/task-store`, task)
                .then(response => {
                    //параметры для модалки с сообщением
                    this.setTitleModalMessage('')
                    this.setBodyModalMessage('Событие добавлено!')
                    //вызвать мутацию для загрузки новой задачи в состояние
                    let newTask = (response.data)
                    this.pushReminderToState(newTask)
                })
                .catch(error => {
                    //массив, для ошибок валидации на бэке
                    let errorsArray = []

                    //вывод ошибки
                    //если есть ошибка валидации name
                    if (error.response.data.errors.name) {
                        for (let i=0; i<error.response.data.errors.name.length; i++) {
                            errorsArray.push(error.response.data.errors.name[i])
                        }
                    }
                    //если есть ошибка валидации description
                    if (error.response.data.errors.description) {
                        for (let i=0; i<error.response.data.errors.description.length; i++) {
                            errorsArray.push(error.response.data.errors.description[i])
                        }
                    }
                    //если есть ошибка валидации даты
                    if (error.response.data.errors.dateStart) {
                        for (let i=0; i<error.response.data.errors.dateStart.length; i++) {
                            errorsArray.push(error.response.data.errors.dateStart[i])
                        }
                    }
                    if (error.response.data.errors.dateEnd) {
                        for (let i=0; i<error.response.data.errors.dateEnd.length; i++) {
                            errorsArray.push(error.response.data.errors.dateEnd[i])
                        }
                    }
                    //если есть ошибка валидации времени
                    if (error.response.data.errors.timeStart) {
                        for (let i=0; i<error.response.data.errors.timeStart.length; i++) {
                            errorsArray.push(error.response.data.errors.timeStart[i])
                        }
                    }
                    if (error.response.data.errors.timeEnd) {
                        for (let i=0; i<error.response.data.errors.timeEnd.length; i++) {
                            errorsArray.push(error.response.data.errors.timeEnd[i])
                        }
                    }
                    //если есть ошибка зачени "Весь день"
                    if (error.response.data.errors.allDay) {
                        for (let i=0; i<error.response.data.errors.allDay.length; i++) {
                            errorsArray.push(error.response.data.errors.allDay[i])
                        }
                    }

                    this.setTitleModalMessage('Ошибка! Событие не добавлено!')
                    let message =''
                    for (let i=0; i<errorsArray.length; i++) {
                        message += errorsArray[i]+"\n"
                    }
                    this.setBodyModalMessage(message)
                });

            // закрыть окно
            this.close();
            this.showCreateEventWindow()
        },

        saveBirthday(birthday) {

            axios.post(`/api/birthday-store`, birthday)
                .then(response => {
                    //параметры для модалки с сообщением
                    this.setTitleModalMessage('')
                    this.setBodyModalMessage('Событие добавлено!')
                    //вызвать мутацию для загрузки нового дня рождения в состояние
                    let newBirthday = (response.data)
                    this.pushBirthdayToState(newBirthday)
                })
                .catch(error => {
                    //массив, для ошибок валидации на бэке
                    let errorsArray = []

                    //вывод ошибки
                    //если есть ошибка валидации name
                    if (error.response.data.errors.name) {
                        for (let i=0; i<error.response.data.errors.name.length; i++) {
                            errorsArray.push(error.response.data.errors.name[i])
                        }
                    }
                    //если есть ошибка валидации description
                    if (error.response.data.errors.description) {
                        for (let i=0; i<error.response.data.errors.description.length; i++) {
                            errorsArray.push(error.response.data.errors.description[i])
                        }
                    }
                    //если есть ошибка валидации даты
                    if (error.response.data.errors.date) {
                        for (let i=0; i<error.response.data.errors.date.length; i++) {
                            errorsArray.push(error.response.data.errors.date[i])
                        }
                    }
                    //если есть ошибка валидации времени
                    if (error.response.data.errors.time) {
                        for (let i=0; i<error.response.data.errors.time.length; i++) {
                            errorsArray.push(error.response.data.errors.time[i])
                        }
                    }
                    //если есть ошибка зачени "Весь день"
                    if (error.response.data.errors.allDay) {
                        for (let i=0; i<error.response.data.errors.allDay.length; i++) {
                            errorsArray.push(error.response.data.errors.allDay[i])
                        }
                    }
                    //если есть ошибка зачени "Каждый год"
                    if (error.response.data.errors.everyYear) {
                        for (let i=0; i<error.response.data.errors.everyYear.length; i++) {
                            errorsArray.push(error.response.data.errors.everyYear[i])
                        }
                    }

                    this.setTitleModalMessage('Ошибка! Событие не добавлено!')
                    let message =''
                    for (let i=0; i<errorsArray.length; i++) {
                        message += errorsArray[i]+"\n"
                    }
                    this.setBodyModalMessage(message)
                })

            // закрыть окно
            this.close();
            this.showCreateEventWindow()

        },

    },

}
</script>

<style scoped>

.content-create-event-window {
    max-width: 1200px;
}
.backdrop-create-event-window {
    z-index: 100;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
}
.create-event-window {
    border-radius: 6px;
    width: 800px;
    background: #FFFFFF;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: auto;
    overflow-y: auto;
}
.window-fade-enter,
.window-fade-leave-active {
    opacity: 0;
}
.window-fade-enter-active,
.window-fade-leave-active {
    transition: opacity .5s ease
}
.btn-outline-primary {
    color: #B2B2B2;
    border-color: #B2B2B2;
}
.create-event {
    padding: 15px;
    text-align: left;
}
.button-close {
    margin-top: 10px;
    padding: 0;
    width: 30px;
    max-width: 100%;
}
.header-create-event {
    border-bottom: 3px solid #F5F5F5;
    padding-bottom: 15px;
    position: relative;
}
.body-create-event {
    padding: 15px 70px;
}
.footer-create-event {
    padding-top: 15px;
}
.error-title {
    text-align: center;
    color: #F44336;
}
.error {
    color: #F44336;
    border-color: #F44336
}

.my-close {
    position: absolute;
    width: 25px;
    top: 0px;
    right: 10px;
}

</style>
