<template>
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
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Дата<span>*</span> / Время<span>*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.date" type="date" class="form-control" id="dateBirthday" name="dateStartBirthday">
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.time" type="time" class="form-control" id="timeBirthday" name="timeStartBirthday" disabled>
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Дата<span class="error">*</span> / Время<span>*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.date" type="date" class="form-control error" id="dateStartBirthday" name="dateStartBirthday">
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.time" type="time" class="form-control" id="timeStartBirthday" name="timeStartBirthday" disabled>
                    </div>
                </template>
            </template>
<!--                            иначе берем дату и время - они обязательны к заполнению -->
            <template v-else>
                <template v-if="!errorDateBirthday && !errorTimeBirthday">
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Дата<span>*</span> / Время<span>*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.date" type="date" class="form-control" id="dateStartBirthday" name="dateStartBirthday">
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.time" type="time" class="form-control" id="timeStartBirthday" name="timeStartBirthday">
                    </div>
                </template>
                <template v-else-if="errorDateBirthday && !errorTimeBirthday">
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Дата<span class="error">*</span> / Время<span>*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.date" type="date" class="form-control error" id="dateStartBirthday" name="dateStartBirthday">
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.time" type="time" class="form-control" id="timeStartBirthday" name="timeStartBirthday">
                    </div>
                </template>
                <template v-else-if="!errorDateBirthday && errorTimeBirthday">
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Дата<span>*</span> / Время<span class="error">*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.date" type="date" class="form-control" id="dateStartBirthday" name="dateStartBirthday">
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.time" type="time" class="form-control error" id="timeStartBirthday" name="timeStartBirthday">
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 col-sm-4 py-2">
                        <label class="form-label">Дата<span class="error">*</span> / Время<span class="error">*</span>:</label>
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.date" type="date" class="form-control error" id="dateStartBirthday" name="dateStartBirthday">
                    </div>
                    <div class="col-6 col-sm-4 py-2">
                        <input v-model.trim="birthday.time" type="time" class="form-control error" id="timeStartBirthday" name="timeStartBirthday">
                    </div>
                </template>
            </template>

            <div class="col-6 col-sm-3 py-2">
                <label class="" for="checkAllDay">Весь день:</label>
            </div>
            <div class="col-6 col-sm-9 py-2">
                <input type="checkbox" class="form-check-input" id="checkAllDay" @click="changeValueAllDay()" :checked="birthday.allDay">
            </div>
            <div class="col-6 col-sm-3 py-2">
                <label class="" for="checkEveryYear">Каждый год:</label>
            </div>
            <div class="col-6 col-sm-9 py-2">
                <input type="checkbox" class="form-check-input" id="checkEveryYear" @click="changeValueEveryYear()" :checked="birthday.everyYear">
            </div>

        </div>
        <div class="row text-center py-3 footer-create-event">
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

    name: "TheBirthday",

    data() {
        return {
            isValid: true,
            errorNameBirthday: false,
            errorDescriptionBirthday: false,
            errorDateBirthday: false,
            errorTimeBirthday: false,

            birthday: {
                id: this.id,
                name: this.name,
                type: 'birthday',
                description: this.description,
                date: this.date,
                time: this.time,
                allDay: this.allDay || false,
                everyYear: this.everyYear || false,
            },
        }
    },

    mounted() {
        // console.log(this.birthday)
        // if (this.allDay === 'true') {
        //     this.birthday.allDay = true
        // } else {
        //     this.birthday.allDay = false
        // }
        document.getElementById("checkAllDay").checked = this.birthday.allDay

        // if (this.everyYear === 'true') {
        //     this.birthday.everyYear = true
        // } else {
        //     this.birthday.everyYear = false
        // }
        document.getElementById("checkEveryYear").checked = this.birthday.everyYear
    },

    props: [
        'id',
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
            this.birthday.id = this.id
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

            if (!this.errorNameBirthday && !this.errorDescriptionBirthday
                    && !this.errorDateBirthday && !this.errorTimeBirthday) {
                this.isValid = true
            } else {
                this.isValid = false
            }

        },

        saveEvent() {

            this.validation()

            if (this.isValid) {

                //прослушиваем событие saveEvent в родительском компоненте
                //передаем параметры - this.birthday
                console.log('1',this.birthday)
                this.$emit('saveEvent', this.birthday)

                this.$bvModal.show('modal-message-ok')

                this.isValid = true

                //сбасываем birthday
                //если пропсы есть (для редактировния), то поля заполнятся их значениями
                //иначе - поля очистятся
                this.birthday.id = this.id
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

@media (max-width: 720px) {
    .body-create-event {
        padding: 15px;
    }
}

</style>
