<template>
    <div>
        <!-- Модальное окно для сообщений-->
        <b-modal id="modal-message" hide-footer :title="titleModalMessage">
            <p class="my-4">{{ bodyModalMessage }}</p>
            <div class="row modal-footer text-center">
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal" @click="$bvModal.hide('modal-message')">ОК</button>
<!--                    <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal" @click="hideModal">ОК</button>-->
                </div>
<!--                <div class="col-6">-->
<!--                    <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">ОК</button>-->
<!--                </div>-->
<!--                <div class="col-6">-->
<!--                    <button type="button" class="btn btn-outline-secondary btn-lg" data-dismiss="modal">Отмена</button>-->
<!--                </div>-->
            </div>
        </b-modal>

        <form id="myForm" @submit.prevent="saveEvent()">
            <div class="row body-create-event">
                <div v-show="!isValid" class="col-12 error-title">
                    <div class="form-label">Заполните все обязательные поля</div>
                </div>
                <template v-if="!errorNameBirthday">
                    <div class="col-12 py-2">
                        <label for="nameBirthday" class="form-label">Название<span>*</span></label>
                        <input v-model.trim="birthday.name" type="text" class="form-control" id="nameBirthday" name="nameBirthday">
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 py-2">
                        <label for="nameBirthday" class="form-label">Название<span class="error">*</span></label>
                        <input v-model.trim="birthday.name" type="text" class="form-control error" id="nameBirthday" name="nameBirthday">
                    </div>
                </template>
                <template v-if="!errorDescriptionBirthday">
                    <div class="col-12 py-2">
                        <label for="descriptionBirthday" class="form-label">Описание<span>*</span></label>
                        <input v-model.trim="birthday.description" type="text" class="form-control" id="descriptionBirthday" name="descriptionBirthday">
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 py-2">
                        <label for="descriptionBirthday" class="form-label">Описание<span class="error">*</span></label>
                        <input v-model.trim="birthday.description" type="text" class="form-control error" id="descriptionBirthday" name="descriptionBirthday">
                    </div>
                </template>
    <!--        Если выбрано значение "Весь день", то время сделать неактивным и оно не обязательно для заполнения,
    в БД будет ложиться значение 00:00,но письма должны отправляться каждый час)-->
                <template v-if="birthday.allDay">
                    <template v-if="!errorDateBirthday">
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span>*</span> / Время<span>*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.date" type="date" class="form-control" id="dateBirthday" name="dateStartBirthday">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.time" type="time" class="form-control" id="timeBirthday" name="timeStartBirthday" disabled>
                        </div>
                    </template>
                    <template v-else>
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span class="error">*</span> / Время<span>*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.date" type="date" class="form-control error" id="dateStartBirthday" name="dateStartBirthday">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.time" type="time" class="form-control" id="timeStartBirthday" name="timeStartBirthday" disabled>
                        </div>
                    </template>
                </template>
    <!--                            иначе берем дату и время - они обязательны к заполнению -->
                <template v-else>
                    <template v-if="!errorDateBirthday && !errorTimeBirthday">
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span>*</span> / Время<span>*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.date" type="date" class="form-control" id="dateStartBirthday" name="dateStartBirthday">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.time" type="time" class="form-control" id="timeStartBirthday" name="timeStartBirthday">
                        </div>
                    </template>
                    <template v-else-if="errorDateBirthday && !errorTimeBirthday">
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span class="error">*</span> / Время<span>*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.date" type="date" class="form-control error" id="dateStartBirthday" name="dateStartBirthday">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.time" type="time" class="form-control" id="timeStartBirthday" name="timeStartBirthday">
                        </div>
                    </template>
                    <template v-else-if="!errorDateBirthday && errorTimeBirthday">
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span>*</span> / Время<span class="error">*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.date" type="date" class="form-control" id="dateStartBirthday" name="dateStartBirthday">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.time" type="time" class="form-control error" id="timeStartBirthday" name="timeStartBirthday">
                        </div>
                    </template>
                    <template v-else>
                        <div class="col-4 py-2">
                            <label class="form-label">Дата<span class="error">*</span> / Время<span class="error">*</span>:</label>
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.date" type="date" class="form-control error" id="dateStartBirthday" name="dateStartBirthday">
                        </div>
                        <div class="col-4 py-2">
                            <input v-model.trim="birthday.time" type="time" class="form-control error" id="timeStartBirthday" name="timeStartBirthday">
                        </div>
                    </template>
                </template>

                <div class="col-3 py-2">
                    <label class="" for="checkAllDay">Весь день:</label>
                </div>
                <div class="col-9 py-2">
                    <input type="checkbox" class="form-check-input" id="checkAllDay" @click="changeValueAllDay()" :checked="birthday.allDay">
                </div>
                <div class="col-3 py-2">
                    <label class="" for="checkEveryYear">Каждый год:</label>
                </div>
                <div class="col-9 py-2">
                    <input type="checkbox" class="form-check-input" id="checkEveryYear" @click="changeValueEveryYear()" :checked="birthday.everyYear">
                </div>

            </div>
            <div class="row text-center py-3 footer-create-event">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
<!--                    <button type="submit" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Сохранить</button>-->
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

    name: "TheBirthday",

    data() {
        return {
            isValid: true,
            errorNameBirthday: false,
            errorDescriptionBirthday: false,
            errorDateBirthday: false,
            errorTimeBirthday: false,

            birthday: {
                name: this.name,
                description: this.description,
                date: this.date,
                time: this.time,
                allDay: Boolean,
                everyYear: Boolean,
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

    mounted() {

        if (this.allDay === 'true') {
            this.birthday.allDay = true
        } else {
            this.birthday.allDay = false
        }
        document.getElementById("checkAllDay").checked = this.birthday.allDay

        if (this.everyYear === 'true') {
            this.birthday.everyYear = true
        } else {
            this.birthday.everyYear = false
        }
        document.getElementById("checkEveryYear").checked = this.birthday.everyYear
    },

    props: [
        'name',
        'description',
        'date',
        'time',
        'allDay',
        'everyYear',
    ],

    methods: {

        close() {

            //сбрасываем ошибки
            this.isValid = true
            this.errorNameBirthday = false
            this.errorDescriptionBirthday = false
            this.errorDateBirthday = false
            this.errorTimeBirthday = false

            //сбасываем birthday
            //если пропсы есть (для редактировния), то поля заполнятся их значениями
            //иначе - поля очистятся
            this.birthday.name = this.name
            this.birthday.description = this.description
            this.birthday.date = this.date
            this.birthday.time = this.time

            if (this.allDay === 'true') {
                this.birthday.allDay = true
            } else {
                this.birthday.allDay = false
            }
            document.getElementById("checkAllDay").checked = this.birthday.allDay

            if (this.everyYear === 'true') {
                this.birthday.everyYear = true
            } else {
                this.birthday.everyYear = false
            }
            document.getElementById("checkEveryYear").checked = this.birthday.everyYear

            //прослушиваем событие close в родительском компоненте
            this.$emit('close');
        },

        validation() {

            //сброс значений ошибок
            this.isValid = true
            this.errorNameBirthday = false
            this.errorDescriptionBirthday = false
            this.errorDateBirthday = false
            this.errorTimeBirthday = false

            if (!this.birthday.name) {
                this.errorNameBirthday = true
            }
            if (!this.birthday.description) {
                this.errorDescriptionBirthday = true
            }
            if (!this.birthday.date) {
                this.errorDateBirthday = true
            }
            if (!this.birthday.time) {
                this.errorTimeBirthday = true
            }

            if (!this.errorNameBirthday && !this.errorDescriptionBirthday && !this.errorDateBirthday && !this.errorTimeBirthday) {
                this.isValid = true
            } else {
                this.isValid = false
            }

        },

        saveEvent() {

            this.validation()

            if (this.isValid) {

                // console.log(this.birthday.name)
                // console.log(this.birthday.description)
                // console.log(this.birthday.date)
                // console.log(this.birthday.time)
                // console.log(this.birthday.allDay)
                // console.log(this.birthday.everyYear)

                //прослушиваем событие saveEvent в родительском компоненте
                //передаем параметры - this.birthday
                this.$emit('saveEvent', this.birthday)

                this.$bvModal.show('modal-message')

                this.isValid = true

                //сбасываем birthday
                //если пропсы есть (для редактировния), то поля заполнятся их значениями
                //иначе - поля очистятся
                this.birthday.name = this.name
                this.birthday.description = this.description
                this.birthday.date = this.date
                this.birthday.time = this.time

                if (this.allDay === 'true') {
                    this.birthday.allDay = true
                } else {
                    this.birthday.allDay = false
                }
                document.getElementById("checkAllDay").checked = this.birthday.allDay

                if (this.everyYear === 'true') {
                    this.birthday.everyYear = true
                } else {
                    this.birthday.everyYear = false
                }
                document.getElementById("checkEveryYear").checked = this.birthday.everyYear
            }
        },

        changeValueAllDay() {

            this.birthday.allDay = !this.birthday.allDay
            this.birthday.time = '00:01' // задаем время по ум. чтобы оно не было пустым и прошло валидацию

        },

        changeValueEveryYear() {
            this.birthday.everyYear = !this.birthday.everyYear
        },

    }

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

div .modal-content .modal-header {
    border-bottom: none;
}

.modal-body .modal-footer {
    border-top: none;
}

</style>
