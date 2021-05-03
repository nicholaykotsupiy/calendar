<template>
    <form id="myForm" @submit.prevent="saveEvent()">
        <div class="row body-create-event">
            <div v-show="!isValid" class="col-12 error-title">
                <div class="form-label">Заполните все обязательные поля</div>
            </div>
            <template v-if="!errorNameTask">
                <div class="col-12 py-2">
                    <label for="nameTask" class="form-label">Название<span>*</span></label>
                    <input v-model="task.name" type="text" class="form-control" id="nameTask" name="nameTask">
                </div>
            </template>
            <template v-else>
                <div class="col-12 py-2">
                    <label for="nameTask" class="form-label">Название<span class="error">*</span></label>
                    <input v-model="task.name" type="text" class="form-control error" id="nameTask" name="nameTask">
                </div>
            </template>
            <div class="col-12 py-2">
                <label for="descriptionTask" class="form-label">Описание</label>
                <input v-model="task.description" type="text" class="form-control descriptionTask" id="descriptionTask" name="descriptionTask">
            </div>

            <div class="col-3 py-2">
                <label class="" for="check">Весь день:</label>
            </div>
            <div class="col-9 py-2">
                <input type="checkbox" class="form-check-input" id="check" @click="changeValueAllDay()" :checked="task.allDay">
            </div>

            <template v-if="!task.allDay">
                <template v-if="errorStartDateTask || errorStartTimeTask">
                    <div class="col-4 py-2">
                        <label class="form-label">Начало<span class="error">*</span>:</label>
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <label class="form-label">Начало<span>*</span>:</label>
                    </div>
                </template>
                <template v-if="errorStartDateTask">
                    <div class="col-4 py-2">
                        <input v-model="task.dateStart" type="date" class="form-control error" id="dateStartTask" name="dateStartTask">
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <input v-model="task.dateStart" type="date" class="form-control" id="dateStartTask" name="dateStartTask">
                    </div>
                </template>
                <template v-if="errorStartTimeTask">
                    <div class="col-4 py-2">
                        <input v-model="task.timeStart" type="time" class="form-control error" id="timeStartTask" name="timeStartTask">
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <input v-model="task.timeStart" type="time" class="form-control" id="timeStartTask" name="timeStartTask">
                    </div>
                </template>
                <template v-if="errorEndDateTask || errorEndTimeTask">
                    <div class="col-4 py-2">
                        <label class="form-label">Окончание<span class="error">*</span>:</label>
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <label class="form-label">Окончание<span>*</span>:</label>
                    </div>
                </template>
                <template v-if="errorEndDateTask">
                    <div class="col-4 py-2">
                        <input v-model="task.dateEnd" type="date" class="form-control error" id="dateEndTask" name="dateEndTask">
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <input v-model="task.dateEnd" type="date" class="form-control" id="dateEndTask" name="dateEndTask">
                    </div>
                </template>
                <template v-if="errorEndTimeTask">
                    <div class="col-4 py-2">
                        <input v-model="task.timeEnd" type="time" class="form-control error" id="timeEndTask" name="timeEndTask">
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <input v-model="task.timeEnd" type="time" class="form-control" id="timeEndTask" name="timeEndTask">
                    </div>
                </template>
            </template>
            <template v-else>
                <template v-if="errorStartDateTask && errorEndDateTask">
                    <div class="col-4 py-2">
                        <label class="form-label">Начало<span class="error">*</span>:</label>
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.dateStart" type="date" class="form-control error" id="dateStartTask" name="dateStartTask">
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.timeStart" type="time" class="form-control" id="timeStartTask" name="timeStartTask" disabled>
                    </div>
                    <div class="col-4 py-2">
                        <label class="form-label">Окончание<span class="error">*</span>:</label>
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.dateEnd" type="date" class="form-control error" id="dateEndTask" name="dateEndTask">
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.timeEnd" type="time" class="form-control" id="timeEndTask" name="timeEndTask" disabled>
                    </div>
                </template>
                <template v-else-if="errorStartDateTask">
                    <div class="col-4 py-2">
                        <label class="form-label">Начало<span class="error">*</span>:</label>
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.dateStart" type="date" class="form-control error" id="dateStartTask" name="dateStartTask">
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.timeStart" type="time" class="form-control" id="timeStartTask" name="timeStartTask" disabled>
                    </div>
                </template>
                <template v-else-if="errorEndDateTask">
                    <div class="col-4 py-2">
                        <label class="form-label">Окончание<span class="error">*</span>:</label>
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.dateEnd" type="date" class="form-control error" id="dateEndTask" name="dateEndTask">
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.timeEnd" type="time" class="form-control" id="timeEndTask" name="timeEndTask" disabled>
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <label class="form-label">Начало<span>*</span>:</label>
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.dateStart" type="date" class="form-control" id="dateStartTask" name="dateStartTask">
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.timeStart" type="time" class="form-control" id="timeStartTask" name="timeStartTask" disabled>
                    </div>
                    <div class="col-4 py-2">
                        <label class="form-label">Окончание<span>*</span>:</label>
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.dateEnd" type="date" class="form-control" id="dateEndTask" name="dateEndTask">
                    </div>
                    <div class="col-4 py-2">
                        <input v-model="task.timeEnd" type="time" class="form-control" id="timeEndTask" name="timeEndTask" disabled>
                    </div>
                </template>
            </template>

        </div>
        <div class="row text-center py-2 footer-create-event">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-outline-secondary btn-lg" @click="close">Отмена</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {

    name: "CreateTask",

    data() {
        return {

            isValid: true,
            errorNameTask: false,
            errorStartDateTask: false,
            errorEndDateTask: false,
            errorStartTimeTask: false,
            errorEndTimeTask: false,

            task: {
                name: '',
                description: '',
                dateStart: '',
                timeStart: '',
                dateEnd: '',
                timeEnd: '',
                allDay: false,
            },

        }
    },

    methods: {

        changeValueAllDay() {

            this.task.allDay = !this.task.allDay
            this.task.timeStart = '00:00' // задаем время по ум. чтобы оно не было пустым и прошло валидацию
            this.task.timeEnd = '00:00'

        },

        close() {

            //очищаем форму
            document.getElementById("myForm").reset()
            //сбрасываем ошибки
            this.isValid = true
            this.errorNameTask = false
            this.errorStartDateTask = false
            this.errorEndDateTask = false
            this.errorStartTimeTask = false
            this.errorEndTimeTask = false

            //очищаем task
            this.task.name = ''
            this.task.description = ''
            this.task.dateStart = ''
            this.task.dateEnd = ''
            this.task.timeStart = ''
            this.task.timeEnd = ''
            this.task.allDay = false

            //прослушиваем событие close в родительском компоненте
            this.$emit('close');

        },

        validation() {

            //сброс значений ошибок
            this.isValid = true
            this.errorNameTask = false
            this.errorStartDateTask = false
            this.errorEndDateTask = false
            this.errorStartTimeTask = false
            this.errorEndTimeTask = false

            if (!this.task.name) {
                this.errorNameTask = true
            }
            if (!this.task.dateStart) {
                this.errorStartDateTask = true
            }
            if (!this.task.dateEnd) {
                this.errorEndDateTask = true
            }
            if (!this.task.timeStart) {
                this.errorStartTimeTask = true
            }
            if (!this.task.timeEnd) {
                this.errorEndTimeTask = true
            }

            if (!this.errorNameTask && !this.errorStartDateTask && !this.errorEndDateTask && !this.errorStartTimeTask && !this.errorEndTimeTask) {
                this.isValid = true
            } else {
                this.isValid = false
            }

        },

        saveEvent() {

            console.log(this.task.name)
            console.log(this.task.description)
            console.log(this.task.dateStart)
            console.log(this.task.dateEnd)
            console.log(this.task.timeStart)
            console.log(this.task.timeEnd)
            console.log(this.task.allDay)

            this.validation()
            console.log('isValid', this.isValid)

            if (this.isValid) {

                // console.log(this.task.name)
                // console.log(this.task.description)
                // console.log(this.task.dateStart)
                // console.log(this.task.dateEnd)
                // console.log(this.task.timeStart)
                // console.log(this.task.timeEnd)
                // console.log(this.task.allDay)

                //прослушиваем событие saveEvent в родительском компоненте
                this.$emit('saveEvent')

                //очищаем форму
                document.getElementById("myForm").reset()
                this.isValid = true
                //очищаем task
                this.task.name = ''
                this.task.description = ''
                this.task.dateStart = ''
                this.task.dateEnd = ''
                this.task.timeStart = ''
                this.task.timeEnd = ''
                this.task.allDay = false

            }

        },

    },
}
</script>

<style scoped>

.content-create-event-window {
    max-width: 1200px;
}

.backdrop-create-event-window {
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

.to-reminder {
    height: 90px;
}

.descriptionTask {
    height: 80px;
}

</style>
