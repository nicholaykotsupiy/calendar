<template>
    <div>

        <b-popover
            :show.sync="pop"
            :target="id"
            placement="leftbottom"
            triggers="click"
        >
            <template #title>
                <div class="icons">
                    <span v-if="event.guests" class="material-icons" @click="openModalGuests()">peoples</span>
                    <span class="material-icons" @click="showModalYesNo">delete</span>
                    <span class="material-icons" @click="showModal">edit</span>
                    <span class="material-icons" @click="popClose">close</span>
                </div>
            </template>
            <div class="title">{{ event.name }}</div>
            <div v-if="event.description" class="title">{{ event.description }}</div>
            <div v-if="event.location" class="title">{{ event.location }}</div>
            <template v-if="event.dateEnd">
                <div class="title">{{ formatData(event.dateStart) }} - {{ formatData(event.dateEnd) }}</div>
            </template>
            <template v-else>
                <div class="title">{{ formatData(event.dateStart) }}</div>
            </template>
            <template v-if="event.timeEnd">
                <div class="title">{{ formatTime(event.timeStart) }} - {{ formatTime(event.timeEnd) }}</div>
            </template>
            <template v-else>
                <div class="title">{{ formatTime(event.timeStart) }}</div>
            </template>
        </b-popover>

        <b-modal id="modal-guests" hide-footer v-model="modalGuestsShow">
            <guests-list-modal :eventItem="event"></guests-list-modal>
            <div class="row text-center">
                <div class="col-12 my-3">
                    <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"
                            @click="$bvModal.hide('modal-guests')"
                    >
                        ОК
                    </button>
                </div>
            </div>
        </b-modal>

    </div>
</template>

<script>
import { mapMutations } from 'vuex'
import GuestsListModal from "../../ModalMessages/GuestsListModal";

export default {

    name: "EditModal",

    components: {
        GuestsListModal
    },

    props: [
        'id',
        'event'
    ],

    data() {
        return {
            pop: false,
            modalGuestsShow: false,
        }
    },

    methods: {

        ...mapMutations([
            'setIsVisibleEditEventWindow',
            'setIsVisibleEditReminderWindow',
            'setIsVisibleEditTaskWindow',
            'setIsVisibleEditBirthdayWindow',
            'setValueDeleteIdEvent',
            'setValueDeleteTypeEvent',
            'setEventEdit',
            'setValueDeleteEvent',
        ]),

        formatData(d) {
            let date = new Date(d);
            let options = {
                month: 'long',
                day: 'numeric',
                weekday: 'short',
                timezone: 'UTC',
            };

            return date.toLocaleString("ru", options)
        },

        formatTime(t) {
            let timeArray = t.split(':');

            return timeArray[0] + ':' + timeArray[1]
        },

        popClose() {
            this.pop = false
        },

        showModalYesNo() {
            this.popClose()
            this.setValueDeleteIdEvent(this.event.id)
            this.setValueDeleteTypeEvent(this.event.type)
            this.setValueDeleteEvent(this.event)
            this.$bvModal.show('modal-message-yes-no')
        },

        showModal() {
            this.popClose()
            this.setEventEdit(this.event)
            if (this.event.type === 'event') {
                this.setIsVisibleEditEventWindow(true)
            }
            if (this.event.type === 'reminder') {
                this.setIsVisibleEditReminderWindow(true)
            }
            if (this.event.type === 'task') {
                this.setIsVisibleEditTaskWindow(true)
            }
            if (this.event.type === 'birthday') {
                this.setIsVisibleEditBirthdayWindow(true)
            }
        },

        openModalGuests() {
            this.modalGuestsShow = !this.modalGuestsShow
        }

    }
}
</script>

<style>

.icons{
    text-align:end;
}
span.material-icons {
    cursor: pointer;
}
.popover {
    z-index: 0;
}

</style>
