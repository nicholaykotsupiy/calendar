<template>
    <div>
        <b-popover
            :show.sync="pop"
            :target="id"
            placement="leftbottom"
            triggers="click"
        >
            <template  #title>
                <div class="icons">
                    <span class="material-icons" @click="showModalYesNo">delete</span>
                    <span class="material-icons" @click="showModal">edit</span>
                    <span class="material-icons"  @click="popClose">close</span>
                </div>
            </template>
            <span class="title">{{ event.name }}</span><br>
            <span class="title">{{ event.description }}</span><br>
            <span class="title">{{ event.timeStart }}</span>
        </b-popover>
    </div>
</template>

<script>
import { mapMutations } from 'vuex'

export default {
    name: "EditModal",

    props: [
        'id',
        'event'
    ],

    data() {
        return {
            pop: false,
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
        ]),

        popClose() {
            this.pop = false
        },

        showModalYesNo() {
            // console.log(this.typeEvent)
            // console.log(this.idEvent)
            this.popClose()
            this.setValueDeleteIdEvent(this.event.id)
            this.setValueDeleteTypeEvent(this.event.type)
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
