<template>
    <table @mousedown="dragTable" @mouseup="clearDrag" class="w-100 border-top events position-relative">
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr
            ref="tr"
            v-for="line in timeLine" :key="new Date().time"
            :style="{height: '60px'}">
            <td
                v-for="(event, index) of events"
                v-if="
                    (line.slice(0, line.indexOf(':')) == event.timeStart.slice(0, event.timeStart.indexOf(':'))
                    &&
                    event.longsDate.includes(formatedDate)
                    &&
                    (event.longsDate.length < 1 || event.longsDate.indexOf(formatedDate) === 0))
                    ||
                    (line.slice(0, line.indexOf(':')) === '00' && event.longsDate.includes(formatedDate) && event.longsDate.indexOf(formatedDate) > 0)"
                :style="{background: event.bg_color, color: event.main_color}"
                :key="index"
                :rowspan="event.longsDate.includes(virification)
                            ? 24 - event.timeStart.slice(0, event.timeStart.indexOf(':')) : event.longsDate.length > 1 ? event.end+1: event.end"
                class="event_item border position-relative">
                <div :style="{borderLeft: '2px solid '+event.main_color}" class="info d-flex align-items-top position-absolute top-0">
                    <span class="exect_time">{{ event.timeStart }}</span>
                    <span class="title">{{ event.name }}</span>
                </div>
                <div class="buttons">
                    <img v-if="event.guests" :src="peoples" alt="peoples">
                    <img :src="del" alt="delete" @click="deleteHandler(event)">
                    <img :src="edit" alt="edit" @click="checkTypeEdit(event)">
                </div>
            </td>
        </tr>
        <DeleteModal
            @delete="deleteEvent"
        />
        <EditEventWindow
            v-if="isVisibleEditEventWindow"
            :event="eventItem"
            @closeEditEventWindow="switchEditEventWindow"
        />
        <EditBirthdayWindow
            v-if="isVisibleEditBirthdayWindow"
            :event="eventItem"
            @closeEditBirthdayWindow="switchEditBirthdayWindow"
        />
        <EditReminderWindow
            v-if="isVisibleEditReminderWindow"
            :event="eventItem"
            @closeEditReminderWindow="switchEditReminderWindow"
        />
        <EditTaskWindow
            v-if="isVisibleEditTaskWindow"
            :event="eventItem"
            @closeEditTaskWindow="switchEditTaskWindow"
        />
    </table>
</template>

<script>
import del from '../../../assets/img/DayCalendar/delete.svg'
import  edit from '../../../assets/img/DayCalendar/edit.svg'
import  peoples from '../../../assets/img/DayCalendar/peoples.png'
import dateformat from "dateformat";
import {mapActions} from "vuex";
import DeleteModal from "../../Events/Delete/DeleteModal";
import EditEventWindow from '../../../components/Events/Edit/EditEventWindow'
import EditBirthdayWindow from '../../../components/Events/Edit/EditBirthdayWindow'
import EditReminderWindow from '../../../components/Events/Edit/EditReminderWindow'
import EditTaskWindow from '../../../components/Events/Edit/EditTaskWindow'
import ModalOK from "../../ModalMessages/ModalOK";

export default {
    name: "DayCalendarEnents",
    components: {
        DeleteModal,
        EditEventWindow,
        EditBirthdayWindow,
        EditReminderWindow,
        EditTaskWindow,
        ModalOK
    },
    props: ['events', 'timeLine', 'currentDate'],
    data: () => ({
        del,
        edit,
        peoples,
        formatedDate: '',
        eventItem: null,
        isVisibleEditEventWindow: false,
        isVisibleEditBirthdayWindow: false,
        isVisibleEditReminderWindow: false,
        isVisibleEditTaskWindow: false,
        clickPosition: null,
    }),
    methods: {
        ...mapActions(['deleteItem']),
        deleteHandler(event) {
            this.eventItem = event
            this.$bvModal.show('id-modal')
        },
        deleteEvent() {
            this.deleteItem(this.eventItem)
            this.$bvModal.hide('id-modal')
            this.$bvModal.show('modal-message-ok')
            this.eventItem = null
        },
        checkTypeEdit(event) {
            this.eventItem = event
            switch (event.type) {
                case 'event':
                    this.switchEditEventWindow()
                    break
                case 'reminder':
                    this.switchEditReminderWindow()
                    break
                case 'birthday':
                    this.switchEditBirthdayWindow()
                    break
                case 'task':
                    this.switchEditTaskWindow()
                    break
            }
        },
        switchEditEventWindow() {
            this.isVisibleEditEventWindow = !this.isVisibleEditEventWindow
        },
        switchEditBirthdayWindow() {
            this.isVisibleEditBirthdayWindow = !this.isVisibleEditBirthdayWindow
        },
        switchEditReminderWindow() {
            this.isVisibleEditReminderWindow = !this.isVisibleEditReminderWindow
        },
        switchEditTaskWindow() {
            this.isVisibleEditTaskWindow = !this.isVisibleEditTaskWindow
        },

        dragTable(event) {
            this.clickPosition = event.offsetX
            document.querySelector('table').onmousemove = this.scrollTable
            document.querySelector('table').style.cursor = 'grabbing'
        },
        clearDrag(event) {
            document.querySelector('table').onmousemove = null
            document.querySelector('table').style.cursor = 'pointer'
        },
        scrollTable(event) {
            let table = document.querySelector('table')

            if(event.offsetX > this.clickPosition ) {
                if(parseInt(table.style.left)) {
                    table.style.left = parseInt(table.style.left)+10+'px'
                }
            }else if(event.offsetX < this.clickPosition && table.clientLeft <= 0) {
                if(parseInt(table.style.left)) {
                    if(parseInt(table.style.left) > 1000 - table.clientWidth) {
                        table.style.left = parseInt(table.style.left)-10+'px'
                    }
                }else {
                    table.style.left = table.clientLeft-10+'px'
                }
            }
        }
    },
    mounted() {
        this.formatedDate = dateformat(this.currentDate, 'yyyy-mm-dd')

        // console.log(this.virification)
        for(let tr of this.$refs.tr){
            if(tr.querySelectorAll('td').length == 1 && tr.querySelector('td').getAttribute('rowspan') == 1) {
                tr.querySelector('td').setAttribute('colspan', 2)
            }
        }
    },
    computed: {
        virification() {
            let date = new Date(this.currentDate)

            date.setDate(date.getDate() + 1)
            return dateformat(date, 'yyyy-mm-dd')
        }
    },
    watch: {
        currentDate() {
            this.formatedDate = dateformat(this.currentDate, 'yyyy-mm-dd')
        }
    }
}
</script>

<style scoped>
    .events {
        position: relative;
        cursor: pointer;
        user-select: none;
    }
    .event_item {
        min-width: 500px;
        /*background: #D2EFFE;*/
        height: 60px;
        /*border-left: 2px solid #19ADF8;*/
    }
    .buttons {
        position: absolute;
        top: 0;
        right: 0;
    }
    .buttons img {
        cursor: pointer;
    }
    .info {
        top: 0px;
        font-weight: 900;
        font-size: 12px;
        line-height: 60px;
        /*color: #2675B5;*/
    }
    .exect_time {
        padding: 0 20px 0 15px;
    }
</style>
