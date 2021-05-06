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
                            <button type="button" class="col-md-1 close" aria-label="Close" @click="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

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

export default {

    name: "CreateEvents",

    components: {
        TheEvent,
        TheReminder,
        TheTask,
        TheBirthday
    },

    data() {
        return {
            isCreateEventWindowVisible: true,
            isCreateReminderWindowVisible: false,
            isCreateTaskWindowVisible: false,
            isCreateBirthdayWindowVisible: false,
        }
    },

    methods: {

        close() {
            this.$emit('closeWrap');
        },

        showCreateEventWindow() {
            this.isCreateEventWindowVisible = true;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
            this.isCreateBirthdayWindowVisible = false;
        },
        showCreateReminderWindow() {
            this.isCreateReminderWindowVisible = true;
            this.isCreateEventWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
            this.isCreateBirthdayWindowVisible = false;
        },
        showCreateTaskWindow() {
            this.isCreateTaskWindowVisible = true;
            this.isCreateEventWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateBirthdayWindowVisible = false;
        },
        showCreateBirthdayWindow() {
            this.isCreateBirthdayWindowVisible = true;
            this.isCreateEventWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
        },

        closeCreateEventWindow() {
            this.close();
            this.isCreateEventWindowVisible = true;
            this.isCreateBirthdayWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
        },
        closeCreateReminderWindow() {
            this.close();
            this.isCreateEventWindowVisible = true;
            this.isCreateBirthdayWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
        },
        closeCreateTaskWindow() {
            this.close();
            this.isCreateEventWindowVisible = true;
            this.isCreateBirthdayWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
        },
        closeCreateBirthdayWindow() {
            this.close();
            this.isCreateEventWindowVisible = true;
            this.isCreateBirthdayWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
        },

        saveEvent(event) {

            //здесь будет метод сохранения данных в БД, пока - в консоль
            console.log('Save event in parent component')
            console.log(event.name)
            console.log(event.description)
            console.log(event.guests)
            console.log(event.location)
            console.log(event.description)
            console.log(event.dateStart)
            console.log(event.dateEnd)
            console.log(event.timeStart)
            console.log(event.timeEnd)

            //после удачного сохранения события спрятать форму
            this.close();
            this.isCreateEventWindowVisible = true;
            this.isCreateBirthdayWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
        },

        saveReminder(reminder) {
            //здесь будет метод сохранения данных в БД, пока - в консоль
            console.log('Save reminder in parent component')

            this.close();
            this.isCreateEventWindowVisible = true;
            this.isCreateBirthdayWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
        },

        saveTask(task) {
            //здесь будет метод сохранения данных в БД, пока - в консоль
            console.log('Save reminder in parent component')

            this.close();
            this.isCreateEventWindowVisible = true;
            this.isCreateBirthdayWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
        },

        saveBirthday(birthday) {
            //здесь будет метод сохранения данных в БД, пока - в консоль
            console.log('Save reminder in parent component')

            this.close();
            this.isCreateEventWindowVisible = true;
            this.isCreateBirthdayWindowVisible = false;
            this.isCreateReminderWindowVisible = false;
            this.isCreateTaskWindowVisible = false;
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

.close {
    position: absolute;
    width: 25px;
    top: 0px;
    right: 10px;
}

</style>
