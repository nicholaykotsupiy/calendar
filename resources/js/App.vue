<template>
    <div id="app">
        <!-- Модальное окно для сообщений об успешном/неуспешном добалении/удалении в БД-->
        <modal-ok></modal-ok>

        <!-- Модальное окно для подтверждения удаления событий-->
        <modal-yes-no
            @deleteMethod="del"
        >
        </modal-yes-no>

        <!--окно редактирования Мероприятия-->
        <edit-event-window
            v-show="isVisibleEditEventWindow"
            @closeEditEventWindow="closeEditEventWindow"
        >
        </edit-event-window>

        <!--окно редактирования Дня рождения-->
        <edit-birthday-window
            v-show="isVisibleEditBirthdayWindow"
            @closeEditBirthdayWindow="closeEditBirthdayWindow"
        >
        </edit-birthday-window>

        <!--окно редактирования Напоминания-->
        <edit-reminder-window
            v-show="isVisibleEditReminderWindow"
            @closeEditReminderWindow="closeEditReminderWindow"
        >
        </edit-reminder-window>

        <!--окно редактирования Задачи-->
        <edit-task-window
            v-show="isVisibleEditTaskWindow"
            @closeEditTaskWindow="closeEditTaskWindow"
        >
        </edit-task-window>

        <DayCalendarWrapper />
    </div>
</template>

<script>
import DayCalendarWrapper from "./components/DayCalendar/DayCalendarWrapper";
import { mapGetters, mapActions, mapMutations } from 'vuex'
import axios from "axios";

export default {

    components: {
        DayCalendarWrapper,
    },

    computed: {

        isVisibleEditEventWindow() {
            return this.isVisibleEditEventWindow
        },
        isVisibleEditReminderWindow() {
            return this.isVisibleEditReminderWindow
        },
        isVisibleEditTaskWindow() {
            return this.isVisibleEditTaskWindow
        },
        isVisibleEditBirthdayWindow() {
            return this.isVisibleEditBirthdayWindow
        },
        valueDeleteIdEvent() {
            return this.valueDeleteIdEvent
        },
        valueDeleteTypeEvent() {
            return this.valueDeleteTypeEvent
        },

        ...mapGetters([
            'currentDate',
            'allEventsForDay',
            'isVisibleEditEventWindow',
            'isVisibleEditTaskWindow',
            'isVisibleEditReminderWindow',
            'isVisibleEditBirthdayWindow',
            'valueDeleteIdEvent',
            'valueDeleteTypeEvent',
        ]),

    },

    methods: {

        ...mapMutations([
            'setTitleModalMessage',
            'setBodyModalMessage',
            'setIsVisibleEditEventWindow',
            'setIsVisibleEditReminderWindow',
            'setIsVisibleEditTaskWindow',
            'setIsVisibleEditBirthdayWindow',
        ]),

        ...mapActions([
            'getDataFromServer'
        ]),

        load() {
            axios.get('/api/events').then(response => {
                this.getDataFromServer(response.data)
            })
        },

        del() {
            //здесь будет происходить определение - какое из видов и id событий удаляем из БД и стейта и само удаление
            console.log(this.valueDeleteIdEvent)//id события
            console.log(this.valueDeleteTypeEvent)//type события

            // axios.delete('/api/...-destroy/{id}')
            //     .then(response => {
            //     //метод
            //
                //сообщение об успешном удалении
                this.setTitleModalMessage('')
                this.setBodyModalMessage('Событие удалено!')
                this.$bvModal.show('modal-message-ok')

                //удаляем из БД и состояния событие по id и type
                console.log('Событие удалено!')
            // })
            // .catch(error => {
            //     //сообщение о неуспешном удалении
            //     this.setTitleModalMessage(error.response.data)
            //     this.setBodyModalMessage('Событие не удалось удалить!')
            //     this.$bvModal.show('modal-message-ok')
            //     console.log('Событие не удалось удалить!')
            // })

        },

        closeEditEventWindow() {
            this.setIsVisibleEditEventWindow(false)
        },
        closeEditReminderWindow() {
            this.setIsVisibleEditReminderWindow(false)
        },
        closeEditTaskWindow() {
            this.setIsVisibleEditTaskWindow(false)
        },
        closeEditBirthdayWindow() {
            this.setIsVisibleEditBirthdayWindow(false)
        },

    },

    mounted() {
        this.load()
    }
}
</script>

<style scoped>

</style>
