<template>
    <form id="myForm" @submit.prevent="saveEvent()">
        <div class="row body-create-event">
            <div v-show="!isValid" class="col-12 error-title">
                <div class="form-label">Заполните все обязательные поля</div>
            </div>
            <template v-if="!errorNameTask">
                <div class="col-12 py-2">
                    <label for="nameTask" class="form-label">Название<span>*</span></label>
                    <input v-model.trim="task.name" type="text" class="form-control" id="nameTask" name="nameTask">
                </div>
            </template>
            <template v-else>
                <div class="col-12 py-2">
                    <label for="nameTask" class="form-label">Название<span class="error">*</span></label>
                    <input v-model.trim="task.name" type="text" class="form-control error" id="nameTask" name="nameTask">
                </div>
            </template>
            <div class="col-12 py-2">
                <label for="descriptionTask" class="form-label">Описание</label>
                <input v-model.trim="task.description" type="text" class="form-control descriptionTask" id="descriptionTask" name="descriptionTask">
            </div>

            <div class="col-6 col-sm-3 py-2">
                <label class="" for="checkAllDay">Весь день:</label>
            </div>
            <div class="col-6 col-sm-9 py-2">
                <input type="checkbox" class="form-check-input" id="checkAllDay" @click="changeValueAllDay()" :checked="task.allDay">
            </div>

            <div v-show="errorDate" class="col-12 error-title py-2">
                <div class="form-label">Дата окончания не должна быть меньше даты начала события</div>
            </div>
            <div v-show="errorTime" class="col-12 error-title py-2">
                <div class="form-label">Время окончания не должно быть меньше или равно времени начала события, разница - минимум час</div>
            </div>

            <template v-if="!task.allDay">
                <template v-if="errorStartDateTask || errorStartTimeTask">
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Начало<span class="error">*</span>:</label>
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Начало<span>*</span>:</label>
                    </div>
                </template>
                <template v-if="errorStartDateTask">
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.dateStart" type="date" class="form-control error" id="dateStartTask" name="dateStartTask">
                    </div>
                </template>
                <template v-else>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.dateStart" type="date" class="form-control" id="dateStartTask" name="dateStartTask">
                    </div>
                </template>
                <template v-if="errorStartTimeTask">
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.timeStart" type="time" class="form-control error" id="timeStartTask" name="timeStartTask">
                    </div>
                </template>
                <template v-else>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.timeStart" type="time" class="form-control" id="timeStartTask" name="timeStartTask">
                    </div>
                </template>
                <template v-if="errorEndDateTask || errorEndTimeTask">
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Окончание<span class="error">*</span>:</label>
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Окончание<span>*</span>:</label>
                    </div>
                </template>
                <template v-if="errorEndDateTask">
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.dateEnd" type="date" class="form-control error" id="dateEndTask" name="dateEndTask">
                    </div>
                </template>
                <template v-else>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.dateEnd" type="date" class="form-control" id="dateEndTask" name="dateEndTask">
                    </div>
                </template>
                <template v-if="errorEndTimeTask">
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.timeEnd" type="time" class="form-control error" id="timeEndTask" name="timeEndTask">
                    </div>
                </template>
                <template v-else>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.timeEnd" type="time" class="form-control" id="timeEndTask" name="timeEndTask">
                    </div>
                </template>
            </template>
            <template v-else>
                <template v-if="errorStartDateTask">
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Начало<span class="error">*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.dateStart" type="date" class="form-control error" id="dateStartTask" name="dateStartTask">
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.timeStart" type="time" class="form-control" id="timeStartTask" name="timeStartTask" disabled>
                    </div>
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Окончание<span class="error">*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.dateEnd" type="date" class="form-control" id="dateEndTask" name="dateEndTask" disabled>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.timeEnd" type="time" class="form-control" id="timeEndTask" name="timeEndTask" disabled>
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Начало<span>*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.dateStart" type="date" class="form-control" id="dateStartTask" name="dateStartTask">
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.timeStart" type="time" class="form-control" id="timeStartTask" name="timeStartTask" disabled>
                    </div>
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Окончание<span>*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.dateEnd" type="date" class="form-control" id="dateEndTask" name="dateEndTask" disabled>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="task.timeEnd" type="time" class="form-control" id="timeEndTask" name="timeEndTask" disabled >
                    </div>
                </template>
            </template>

        </div>
        <div class="row text-center py-2 footer-create-event">
            <div class="col-6">
                <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-outline-secondary btn-lg" @click="close">Отмена</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {

    name: "TheTask",

    data() {
        return {

            isValid: true,
            errorNameTask: false,
            errorStartDateTask: false,
            errorEndDateTask: false,
            errorStartTimeTask: false,
            errorEndTimeTask: false,
            errorDate: false,
            errorTime: false,

            task: {
                id: this.id,
                type: 'task',
                name: this.name,
                description: this.description || null,
                dateStart: this.dateStart,
                timeStart: this.timeStart,
                dateEnd: this.dateEnd,
                timeEnd: this.timeEnd,
                allDay: this.allDay || false,
            },

        }
    },

    props: [
        'id',
        'name',
        'description',
        'dateStart',
        'timeStart',
        'dateEnd',
        'timeEnd',
        'allDay'
    ],

    methods: {

        changeValueAllDay() {
            this.task.allDay = !this.task.allDay
            this.task.timeStart = '00:01' // задаем время по ум. чтобы оно не было пустым и прошло валидацию
            this.task.timeEnd = '23:59'
            this.task.dateEnd = this.task.dateStart
        },

        close() {

            //сбрасываем ошибки
            this.isValid = true
            this.errorNameTask = false
            this.errorStartDateTask = false
            this.errorEndDateTask = false
            this.errorStartTimeTask = false
            this.errorEndTimeTask = false
            this.errorDate = false
            this.errorTime = false

            //сбрасываем task
            this.task.name = this.name
            this.task.description = this.description || null
            this.task.dateStart = this.dateStart
            this.task.dateEnd = this.dateEnd
            this.task.timeStart = this.timeStart
            this.task.timeEnd = this.timeEnd

            if (this.allDay === 'true') {
                this.task.allDay = true
            } else {
                this.task.allDay = false
            }
            document.getElementById("checkAllDay").checked = this.task.allDay

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
            this.errorDate = false
            this.errorTime = false

            //проверка на незаполненность полей
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

            //проверка даты
            if (this.task.dateStart > this.task.dateEnd) {
                this.errorStartDateTask = true
                this.errorEndDateTask = true
                this.errorDate = true
            }

            if (this.task.timeStart && this.task.timeEnd) {
                //разница между времением - минимум час если даты совпадают
                let firstTime = this.task.timeStart.split(':')
                let secondTime = this.task.timeEnd.split(':')
                let firstTimeInMinuts = firstTime[0]*60+firstTime[1]
                let secondTimeInMinuts = secondTime[0]*60+secondTime[1]
                let different = (secondTimeInMinuts - firstTimeInMinuts)/100

                //проверка времени
                if (this.task.dateStart === this.task.dateEnd && ( this.task.timeStart >= this.task.timeEnd || different < 60) ) {
                    this.errorStartTimeTask = true
                    this.errorEndTimeTask = true
                    this.errorTime = true
                }
            }

            if (!this.errorNameTask && !this.errorStartDateTask && !this.errorEndDateTask && !this.errorStartTimeTask
                    && !this.errorEndTimeTask) {
                this.isValid = true
            } else {
                this.isValid = false
            }

        },

        saveEvent() {

            //если стоит флажок allDay, то конечной дате присваим значение начальной
            if (this.task.allDay) {
                this.task.dateEnd = this.task.dateStart
            }

            this.validation()

            if (this.isValid) {

                //прослушиваем событие saveEvent в родительском компоненте, передаем в параметрах this.task
                this.$emit('saveEvent', this.task)

                this.$bvModal.show('modal-message-ok')

                this.isValid = true

                //сбрасываем task
                this.task.id = this.id
                this.task.name = this.name
                this.task.description = this.description || null
                this.task.dateStart = this.dateStart
                this.task.dateEnd = this.dateEnd
                this.task.timeStart = this.timeStart
                this.task.timeEnd = this.timeEnd

                if (this.allDay) {
                    this.task.allDay = true
                } else {
                    this.task.allDay = false
                }
                document.getElementById("checkAllDay").checked = this.task.allDay

            }

        },

    },
}
</script>

<style scoped>

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

@media (max-width: 720px) {
    .body-create-event {
        padding: 15px;
    }
}

</style>
