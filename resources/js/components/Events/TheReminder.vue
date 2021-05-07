<template>
    <div>

        <!-- Модальное окно для сообщений-->
        <b-modal id="modal-message" hide-footer :title="titleModalMessage">
            <p class="my-4 body-message">{{ bodyModalMessage }}</p>
            <div class="row modal-footer text-center">
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"
                            @click="$bvModal.hide('modal-message')"
                    >
                        ОК
                    </button>
                </div>
            </div>
        </b-modal>

        <form id="myForm" @submit.prevent="saveEvent()">
            <div class="row body-create-event">
                <div v-show="!isValid" class="col-12 error-title">
                    <div class="form-label">Заполните все обязательные поля</div>
                </div>
                <template v-if="!errorNameReminder">
                    <div class="col-12 py-2">
                        <label for="nameReminder" class="form-label">Название<span>*</span></label>
                        <input v-model.trim="reminder.name" type="text" class="form-control" id="nameReminder" name="nameReminder">
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 py-2">
                        <label for="nameReminder" class="form-label">Название<span class="error">*</span></label>
                        <input v-model.trim="reminder.name" type="text" class="form-control error" id="nameReminder" name="nameReminder">
                    </div>
                </template>

    <!--        Если выбрано значение "Весь день", то время сделать неактивным и оно не обязательно для заполнения,
                в БД будет ложиться значение 00:00,но письма должны отправляться каждый час)-->
                <template v-if="allDay">
                    <template v-if="!errorDateReminder">
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span>*</span> / Время<span>*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.date" type="date" class="form-control" id="dateStartEvent" name="dateStartEvent">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.time" type="time" class="form-control" id="timeStartEvent" name="timeStartEvent" disabled>
                        </div>
                    </template>
                    <template v-else>
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span class="error">*</span> / Время<span>*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.date" type="date" class="form-control error" id="dateStartEvent" name="dateStartEvent">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.time" type="time" class="form-control" id="timeStartEvent" name="timeStartEvent" disabled>
                        </div>
                    </template>
                </template>
    <!--                            иначе берем дату, время - они обязательны к заполнению -->
                <template v-else>
                    <template v-if="!errorDateReminder && !errorTimeReminder">
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span>*</span> / Время<span>*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.date" type="date" class="form-control" id="dateStartEvent" name="dateStartEvent">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.time" type="time" class="form-control" id="timeStartEvent" name="timeStartEvent">
                        </div>
                    </template>
                    <template v-else-if="errorDateReminder && !errorTimeReminder">
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span class="error">*</span> / Время<span>*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.date" type="date" class="form-control error" id="dateStartEvent" name="dateStartEvent">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.time" type="time" class="form-control" id="timeStartEvent" name="timeStartEvent">
                        </div>
                    </template>
                    <template v-else-if="!errorDateReminder && errorTimeReminder">
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span>*</span> / Время<span class="error">*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.date" type="date" class="form-control" id="dateStartEvent" name="dateStartEvent">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.time" type="time" class="form-control error" id="timeStartEvent" name="timeStartEvent">
                        </div>
                    </template>
                    <template v-else>
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span class="error">*</span> / Время<span class="error">*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.date" type="date" class="form-control error" id="dateStartEvent" name="dateStartEvent">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="reminder.time" type="time" class="form-control error" id="timeStartEvent" name="timeStartEvent">
                        </div>
                    </template>
                </template>

                <div class="col-12 py-2">
                    <div class="row">
                        <div class="col-4">
                            <label class="" for="selectToReminder">Повторять:</label>
                        </div>
                        <div class="col-8">
                            <select v-model="reminder.toRepeat" class="form-control to-reminder" id="selectToReminder"
                                    @change="changeValueAllDay()"
                            >
                                <option v-for="(repeatVal, index) in arrayToRepeat">{{ arrayToRepeat[index] }}</option>
                            </select>
                        </div>
                    </div>
                </div>
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
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

    name: "TheReminder",

    data() {
        return {

            isValid: true,
            errorNameReminder: false,
            errorDateReminder: false,
            errorTimeReminder: false,

            arrayToRepeat: ['не повторять', 'ежедневно', 'еженедельно', 'каждый год', 'весь день'],
            allDay: false,

            reminder: {
                name: this.name,
                date: this.date,
                time: this.time,
                toRepeat: this.toRepeat || 'не повторять', // Не повторять - default
            },

        }
    },

    computed: {

        titleModalMessage() {
            return this.titleModalMessage
        },

        bodyModalMessage() {
            return this.bodyModalMessage
        },

        ...mapGetters([
            'titleModalMessage',
            'bodyModalMessage',
        ])
    },

    props: [
        'id',
        'name',
        'date',
        'time',
        'toRepeat'
    ],

    mounted() {
        document.querySelector('#selectToReminder').value = this.toRepeat || 'не повторять'

        if (this.toRepeat === 'весь день') {
            this.allDay = true
            this.reminder.time = '00:01' // задаем время по ум. чтобы оно не было пустым и прошло валидацию
        } else {
            this.allDay = false
        }
    },

    methods: {

        changeValueAllDay() {

            if (this.reminder.toRepeat === 'весь день') {
                this.allDay = true
                this.reminder.time = '00:01' // задаем время по ум. чтобы оно не было пустым и прошло валидацию
            } else {
                this.allDay = false
            }

        },

        close() {

            //устанавливаем значения по умолчанию с учетом возможных пропсов
            //сбрасываем reminder
            this.reminder.name = this.name
            this.reminder.date = this.date
            this.reminder.time = this.time
            this.reminder.toRepeat = this.toRepeat || 'не повторять'

            if (this.toRepeat === 'Весь день') {
                this.allDay = true
                this.reminder.time = '00:01' // задаем время по ум. чтобы оно не было пустым и прошло валидацию
            } else {
                this.allDay = false
            }

            document.querySelector('#selectToReminder').value = this.reminder.toRepeat

            //сбрасываем ошибки
            this.isValid = true
            this.errorNameReminder = false
            this.errorDateReminder = false
            this.errorTimeReminder = false

            //прослушиваем событие close в родительском компоненте
            this.$emit('close');

        },

        validation() {

            //сброс значений ошибок
            this.isValid = true
            this.errorNameReminder = false
            this.errorDateReminder = false
            this.errorTimeReminder = false

            if (!this.reminder.name) {
                this.errorNameReminder = true
            }
            if (!this.reminder.date) {
                this.errorDateReminder = true
            }
            if (!this.reminder.time) {
                this.errorTimeReminder = true
            }

            if (!this.errorNameReminder && !this.errorDateReminder && !this.errorTimeReminder) {
                this.isValid = true
            } else {
                this.isValid = false
            }

        },

        saveEvent() {

            // console.log(this.reminder.name)
            // console.log(this.reminder.date)
            // console.log(this.reminder.time)
            // console.log(this.reminder.toRepeat)

            this.validation()

            if (this.isValid) {

                //прослушиваем событие saveEvent в родительском компоненте
                this.$emit('saveEvent', this.reminder)

                this.$bvModal.show('modal-message')

                //устанавливаем значения по умолчанию с учетом возможных пропсов
                //сбрасываем reminder
                this.reminder.name = this.name
                this.reminder.date = this.date
                this.reminder.time = this.time
                this.reminder.toRepeat = this.toRepeat || 'не повторять'
                // console.log( this.reminder.toRepeat)

                if (this.toRepeat === 'Весь день') {
                    this.allDay = true
                    this.reminder.time = '00:01' // задаем время по ум. чтобы оно не было пустым и прошло валидацию
                } else {
                    this.allDay = false
                }

                document.querySelector('#selectToReminder').value = this.reminder.toRepeat

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

.modal-header {
    border-bottom: none;
}

.modal-body .modal-footer {
    border-top: none;
}

.body-message {
    text-align: center;
    font-size: 18px;
}

</style>
