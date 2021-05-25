<template>
    <div id="app">
        <!-- Модальное окно для сообщений об успешном/неуспешном добалении/удалении в БД-->
        <ModalOK />

        <!-- Модальное окно для подтверждения удаления событий-->
        <modal-yes-no
            @deleteMethod="deleteEvents"
        >
        </modal-yes-no>

        <!--окно редактирования Мероприятия-->
        <edit-event-window
            v-if="isVisibleEditEventWindow"
            :event="$store.state.eventEdit"
            @closeEditEventWindow="closeEditEventWindow"
        >
        </edit-event-window>

        <!--окно редактирования Дня рождения-->
        <edit-birthday-window
            v-if="isVisibleEditBirthdayWindow"
            :event="$store.state.eventEdit"
            @closeEditBirthdayWindow="closeEditBirthdayWindow"
        >
        </edit-birthday-window>

        <!--окно редактирования Напоминания-->
        <edit-reminder-window
            v-if="isVisibleEditReminderWindow"
            :event="$store.state.eventEdit"
            @closeEditReminderWindow="closeEditReminderWindow"
        >
        </edit-reminder-window>

        <!--окно редактирования Задачи-->
        <edit-task-window
            v-if="isVisibleEditTaskWindow"
            :event="$store.state.eventEdit"
            @closeEditTaskWindow="closeEditTaskWindow"
        >
        </edit-task-window>

        <router-view />
    </div>
</template>

<script>
import DayCalendarWrapper from "./components/DayCalendar/DayCalendarWrapper";
import EditEventWindow from "./components/Events/Edit/EditEventWindow";
import EditBirthdayWindow from './components/Events/Edit/EditBirthdayWindow'
import EditReminderWindow from './components/Events/Edit/EditReminderWindow'
import EditTaskWindow from './components/Events/Edit/EditTaskWindow'
import ModalOK from "./components/ModalMessages/ModalOK";
import ModalYesNo from "./components/ModalMessages/ModalYesNo";
import { mapGetters, mapActions, mapMutations } from 'vuex'
import axios from "axios";

export default {

    components: {
        DayCalendarWrapper,
        EditEventWindow,
        EditBirthdayWindow,
        EditReminderWindow,
        EditTaskWindow,
        ModalOK,
        ModalYesNo
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
        valueDeleteEvent() {
            return this.valueDeleteEvent
        },

        holidays() {
            return this.holidays
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
            'holidays',
            'valueDeleteEvent'
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
            'addHolidaysToState',
            'deleteEvent',
            'deleteReminder',
            'deleteBirthday',
            'deleteTask',
        ]),

        ...mapActions([
            'getDataFromServer'
        ]),

        load() {
            if(JSON.parse(window.localStorage.getItem('vuex'))){
                let token = JSON.parse(window.localStorage.getItem('vuex')).access_token
                axios.post('/api/events', {token}).then(response => {
                    // console.log(response.data)
                    this.getDataFromServer(response.data)
                })
            }
            axios
                .get('https://www.googleapis.com/calendar/v3/calendars/ru.ukrainian%23holiday%40group.v.calendar.google.com/events?key=AIzaSyCXtY_r4WvIlu_2N_iVZC8WTc_iXDkZMGM')
                .then(response => {
                    let holidays = {};
                    for (let i = 0; i < response.data.items.length; i++) {
                        let day = response.data.items[i].start.date
                        if (!(day in holidays)) {
                            holidays[day] = []
                        }
                        holidays[day].push(response.data.items[i])
                    }
                    this.addHolidaysToState(holidays)
                })
        },

        deleteEvents() {
            if (this.valueDeleteTypeEvent === 'event') {
                this.deleteEvent(this.valueDeleteEvent)
                // this.deleteEvent(this.valueDeleteIdEvent)
                this.$bvModal.show('modal-message-ok')
            }
            if (this.valueDeleteTypeEvent === 'reminder') {
                this.deleteReminder(this.valueDeleteEvent)
                // this.deleteReminder(this.valueDeleteIdEvent)
                this.$bvModal.show('modal-message-ok')
            }
            if (this.valueDeleteTypeEvent === 'birthday') {
                this.deleteBirthday(this.valueDeleteEvent)
                // this.deleteBirthday(this.valueDeleteIdEvent)
                this.$bvModal.show('modal-message-ok')
            }
            if (this.valueDeleteTypeEvent === 'task') {
                this.deleteTask(this.valueDeleteEvent)
                // this.deleteTask(this.valueDeleteIdEvent)
                this.$bvModal.show('modal-message-ok')
            }

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
