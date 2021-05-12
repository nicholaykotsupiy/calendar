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
            <span class="title">{{ editModalTitle }}</span><br>
            <span class="title">{{ description }}</span><br>
            <span class="title">{{ editModalTime }}</span>
        </b-popover>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'

export default {
    name: "EditModal",

    props: [
        'id',
        'typeEvent',
        'idEvent',
        'editModalTitle',
        'editModalTime',
        'description'
    ],

    computed: {

        // ...mapGetters([
        //     'editModalTitle',
        //     'editModalTime',
        // ]),
    },

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
        ]),

        popClose() {
            this.pop = false
        },

        showModalYesNo() {
            console.log(this.typeEvent)
            console.log(this.idEvent)
            this.setValueDeleteIdEvent(this.idEvent)
            this.setValueDeleteTypeEvent(this.typeEvent)
            this.$bvModal.show('modal-message-yes-no')
        },

        showModal() {
            console.log(this.typeEvent)
            if (this.typeEvent === 'event') {
                this.setIsVisibleEditEventWindow(true)
            }
            if (this.typeEvent === 'reminder') {
                this.setIsVisibleEditReminderWindow(true)
            }
            if (this.typeEvent === 'task') {
                this.setIsVisibleEditTaskWindow(true)
            }
            if (this.typeEvent === 'birthday') {
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
