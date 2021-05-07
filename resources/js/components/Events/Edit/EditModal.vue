<template>
    <div>

        <!--        пример вызова окна редактирования Мероприятия-->
                                <edit-event-window
                                    v-show="isVisibleModal"
                                    @closeEditEventWindow="close"
                                >
                                </edit-event-window>

        <!--        пример вызова окна редактирования Дня рождения-->
<!--                <edit-birthday-window-->
<!--                    v-show="isVisibleModal"-->
<!--                    @closeEditBirthdayWindow="close"-->
<!--                >-->
<!--                </edit-birthday-window>-->

        <!--        пример вызова окна редактирования Напоминания-->
        <!--        <edit-reminder-window-->
        <!--            v-show="isVisibleModal"-->
        <!--            @closeEditReminderWindow="close"-->
        <!--        >-->
        <!--        </edit-reminder-window>-->

        <!--        пример вызова окна редактирования Задачи-->
        <!--        <edit-task-window-->
        <!--            v-show="isVisibleModal"-->
        <!--            @closeEditTaskWindow="close"-->
        <!--        >-->
        <!--        </edit-task-window>-->

        <b-popover
            :show.sync="pop"
            :target="id"
            placement="leftbottom"
            triggers="click"
        >
            <template  #title>
                <div class="icons">
                    <span class="material-icons">delete</span>
                    <span class="material-icons" @click="showModal()" >edit</span>
                    <span class="material-icons"  @click="popClose">close</span>
                </div>
            </template>
            <span class="title">Вселенная через 1 час</span><br>
            <span class="time">Суббота, 7 января 4:00 - 4:10</span>
        </b-popover>
    </div>
</template>

<script>


export default {
    name: "EditModal",

    props: {
      id: String
    },
    data() {
        return {
            pop: false,
            isVisibleModal: false,
        }
    },
    methods: {
        popClose() {
            this.pop = false
        },
        showModal() {
            this.isVisibleModal = true;
        },

        // close() {
        //     this.isVisibleModal = false;
        // },
        //
        // saveClickEvent() {
        //     //console.log('Save event')
        //     //после удачного сохранения события спрятать форму
        //     this.isCreateEventWindowVisible = false;
        // },
    }
}
</script>

<style scoped>
.icons{
    text-align:end;
}
</style>
