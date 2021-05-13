<template>
<!--    <transition name="window-fade">-->
        <div class="content-create-event-window">
            <div class="backdrop-create-event-window">
                <div class="create-event-window">
                    <div class="create-event">
                        <div class="row justify-content-between py-2 header-create-event">
                            <div class="col-md-11">
                                <div class="row text-center y-2">
                                    <div class="col-md-12">
                                        <div class="center-title">
                                            Редактировать Задачу
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="col-md-1 close my-close" aria-label="Close" @click="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

<!--        Компонент - модальное окно для создания Задачи-->
                        <template v-if="event">
                            <the-task
                                :id="event.id"
                                :name="event.name"
                                :description="event.description"
                                :dateStart="event.dateStart"
                                :timeStart="event.timeStart"
                                :dateEnd="event.dateEnd"
                                :timeEnd="event.timeEnd"
                                :allDay="event.allDay"
                                @close="close"
                                @saveEvent="saveChangeTask"
                            >
                            </the-task>
                        </template>
                    </div>
                </div>
            </div>
        </div>
<!--    </transition>-->
</template>

<script>
import TheTask from "../TheTask";
import {mapActions} from "vuex";

export default {

    name: "EditTaskWindow",

    components: {TheTask},
    props: ['event'],

    methods: {
        ...mapActions([
            'editItem'
        ]),
        close() {
            //прослушиваем событие closeEditEventWindow в родительском компоненте
            this.$emit('closeEditTaskWindow');
        },

        saveChangeTask(task) {

            //валидация данных, которая расписана в компоненте, после успешной валидации -
            //здесь будет метод сохранения измененных данных в БД, пока - в консоль
            // console.log('Save task in parent component')
            //
            // console.log(task.name)
            // console.log(task.description)
            // console.log(task.dateStart)
            // console.log(task.dateEnd)
            // console.log(task.timeStart)
            // console.log(task.timeEnd)
            // console.log(task.allDay)
            this.editItem(task)

            //после удачного сохранения события спрятать форму
            this.close();
        }

    }

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

.my-close {
    position: absolute;
    width: 25px;
    top: 0px;
    right: 10px;
}

.center-title {
    font-size: 18px;
}

</style>
