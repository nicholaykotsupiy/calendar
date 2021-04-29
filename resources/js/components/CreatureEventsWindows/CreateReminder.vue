<template>
    <transition name="window-fade">
        <div class="content-create-event-window">
            <div class="backdrop-create-event-window">
                <div class="create-event-window">
                    <form class="create-event" id="myForm" @submit.prevent="saveEvent()">
                        <div class="row justify-content-between py-2 header-create-event">
                            <div class="col-md-11">
                                <div class="row text-center py-2">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-outline-primary">Мероприятие</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary">Напоминание</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-outline-primary">Задача</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-outline-primary">День рождения</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="col-md-1 close" aria-label="Close" @click="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row body-create-event">
                            <div v-show="!isValid" class="col-12 error-title">
                                <div class="form-label">Заполните все обязательные поля</div>
                            </div>
                            <template v-if="!errorNameReminder">
                                <div class="col-12 py-2">
                                    <label for="nameReminder" class="form-label">Название<span>*</span></label>
                                    <input v-model="reminder.name" type="text" class="form-control" id="nameReminder" name="nameReminder">
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-12 py-2">
                                    <label for="nameReminder" class="form-label">Название<span class="error">*</span></label>
                                    <input v-model="reminder.name" type="text" class="form-control error" id="nameReminder" name="nameReminder">
                                </div>
                            </template>

<!--                            Если выбран флажок "Весь день", то дату скрыть и она не обязательна для заполнения,
                            в БД будет ложиться NULL в Date (если это возможно или 00:00,но письма должны отправляться каждый час)-->
                            <template v-if="reminder.allDay">
                                <template v-if="!errorDateReminder">
                                    <div class="col-4 py-2">
                                        <label class="form-label">Дата<span>*</span>:</label>
                                    </div>
                                    <div class="col-8 py-2">
                                        <input v-model="reminder.date" type="date" class="form-control" id="dateStartEvent" name="dateStartEvent">
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="col-4 py-2">
                                        <label class="form-label">Дата<span class="error">*</span>:</label>
                                    </div>
                                    <div class="col-8 py-2">
                                        <input v-model="reminder.date" type="date" class="form-control error" id="dateStartEvent" name="dateStartEvent">
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
                                        <input v-model="reminder.date" type="date" class="form-control" id="dateStartEvent" name="dateStartEvent">
                                    </div>
                                    <div class="col-4 py-2">
                                        <input v-model="reminder.time" type="time" class="form-control" id="timeStartEvent" name="timeStartEvent">
                                    </div>
                                </template>
                                <template v-else-if="errorDateReminder && !errorTimeReminder">
                                    <div class="col-4 py-2">
                                        <label class="form-label">Дата<span class="error">*</span> / Время<span>*</span>:</label>
                                    </div>
                                    <div class="col-4 py-2">
                                        <input v-model="reminder.date" type="date" class="form-control error" id="dateStartEvent" name="dateStartEvent">
                                    </div>
                                    <div class="col-4 py-2">
                                        <input v-model="reminder.time" type="time" class="form-control" id="timeStartEvent" name="timeStartEvent">
                                    </div>
                                </template>
                                <template v-else-if="!errorDateReminder && errorTimeReminder">
                                    <div class="col-4 py-2">
                                        <label class="form-label">Дата<span>*</span> / Время<span class="error">*</span>:</label>
                                    </div>
                                    <div class="col-4 py-2">
                                        <input v-model="reminder.date" type="date" class="form-control" id="dateStartEvent" name="dateStartEvent">
                                    </div>
                                    <div class="col-4 py-2">
                                        <input v-model="reminder.time" type="time" class="form-control error" id="timeStartEvent" name="timeStartEvent">
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="col-4 py-2">
                                        <label class="form-label">Дата<span class="error">*</span> / Время<span class="error">*</span>:</label>
                                    </div>
                                    <div class="col-4 py-2">
                                        <input v-model="reminder.date" type="date" class="form-control error" id="dateStartEvent" name="dateStartEvent">
                                    </div>
                                    <div class="col-4 py-2">
                                        <input v-model="reminder.time" type="time" class="form-control error" id="timeStartEvent" name="timeStartEvent">
                                    </div>
                                </template>
                            </template>

                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-3">
                                        <label class="" for="check">Весь день:</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" class="form-check-input" id="check" @click="changeValueAllDay()" :checked="reminder.allDay">
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleFormControlSelect2">{{ reminder.toRepeat[0] }}</label>
                                        <select multiple v-model="reminder.toRepeat" class="form-control to-reminder" id="exampleFormControlSelect2">
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
            </div>
        </div>
    </transition>
</template>

<script>
export default {

    name: "CreateReminder",

    data() {
        return {

            isValid: true,
            errorNameReminder: false,
            errorDateReminder: false,
            errorTimeReminder: false,

            // arrayToRepeat: ['Ежедневно', 'Еженедельно', 'Каждый год', 'Не повторять', 'Другое'],
            arrayToRepeat: ['Ежедневно', 'Еженедельно', 'Каждый год', 'Не повторять'],

            reminder: {
                name: '',
                date: '',
                time: '',
                allDay: false,
                toRepeat: ['Не повторять'], // Не повторять - default
            },
        }
    },

    methods: {

        changeValueAllDay() {

            this.reminder.allDay = !this.reminder.allDay
            this.reminder.time = '00:00' // задаем время по ум. чтобы оно не было пустым и прошло валидацию

        },

        close() {

            //очищаем форму
            document.getElementById("myForm").reset()
            //сбрасываем ошибки
            this.isValid = true
            this.errorNameReminder = false
            this.errorDateReminder = false
            this.errorTimeReminder = false

            //очищаем reminder
            this.reminder.name = ''
            this.reminder.date = ''
            this.reminder.time = ''
            this.reminder.allDay = false
            this.reminder.toRepeat = ['Не повторять']

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

            console.log(this.reminder.name)
            console.log(this.reminder.date)
            console.log(this.reminder.time)
            console.log(this.reminder.allDay)
            console.log(this.reminder.toRepeat[0])

            this.validation()
            console.log('isValid', this.isValid)

            if (this.isValid) {

                // console.log(this.reminder.name)
                // console.log(this.reminder.date)
                // console.log(this.reminder.time)
                // console.log(this.reminder.allDay)
                // console.log(this.reminder.toRepeat[0])

                //прослушиваем событие saveEvent в родительском компоненте
                this.$emit('saveEvent')

                //очищаем форму
                document.getElementById("myForm").reset()
                this.isValid = true
                //очищаем reminder
                this.reminder.name = ''
                this.reminder.date = ''
                this.reminder.time = ''
                this.reminder.allDay = false
                this.reminder.toRepeat = ['Не повторять']

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

form.create-event {
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

</style>
