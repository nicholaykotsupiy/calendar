<template>
    <div class="col-6">

        <!--        Модальное окно для создания всех событий-->
        <create-events-window
            v-show="isVisibleModal"
            @closeWrap="close"
        >
        </create-events-window>

        <!--        пример вызова окна редактирования Мероприятия-->
        <!--                <edit-event-window-->
        <!--                    v-show="isVisibleModal"-->
        <!--                    @closeEditEventWindow="close"-->
        <!--                >-->
        <!--                </edit-event-window>-->

        <!--        пример вызова окна редактирования Дня рождения-->
        <!--        <edit-birthday-window-->
        <!--            v-show="isVisibleModal"-->
        <!--            @closeEditBirthdayWindow="close"-->
        <!--        >-->
        <!--        </edit-birthday-window>-->

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

        <div class="button d-flex justify-content-center text-white fw-bold text-uppercase rounded border-2 mb-2"
             @click="showModal()">
            Создать
        </div>

    </div>
</template>

<script>
export default {

    name: "BaseLeftBarButton",

    data() {

        return {
            isVisibleModal: false,
        }
    },

    methods: {

        showModal() {
            this.isVisibleModal = true;
        },

        close() {
            this.isVisibleModal = false;
        },

        saveClickEvent() {
            //console.log('Save event')
            //после удачного сохранения события спрятать форму
            this.isCreateEventWindowVisible = false;
        },
    }
}
</script>

<style scoped>
.button {
    font-family: Roboto;
    background: #1875F0;
    font-weight: 900;
    font-size: 12px;
    line-height: 50px;
    letter-spacing: 1.5px;
    padding: 2px 15px;
    cursor: pointer;
}
</style>
