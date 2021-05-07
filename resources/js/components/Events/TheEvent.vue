<template>
    <div>
        <!-- Модальное окно для сообщений-->
        <b-modal id="modal-message-event" hide-footer :title="titleModalMessage">
            <p class="my-4 body-message">{{ bodyModalMessage }}</p>
            <div class="row modal-footer text-center">
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"
                            @click="$bvModal.hide('modal-message-event')"
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
                <template v-if="!errorNameEvent">
                    <div class="col-12">
                        <label for="nameEvent" class="form-label">Название<span>*</span></label>
                        <input v-model.trim="event.name" type="text" class="form-control" id="nameEvent" name="nameEvent">
                    </div>
                </template>
                <template v-else>
                    <div class="col-12">
                        <label for="nameEvent" class="form-label">Название<span class="error">*</span></label>
                        <input v-model.trim="event.name" type="text" class="form-control error" id="nameEvent" name="nameEvent">
                    </div>
                </template>
                <template v-if="!errorGuestsEvent">
                    <div class="col-12 py-2">
                        <label for="guestsEvent" class="form-label">
                            Гости <span class="warning">(емейлы гостей должны быть разделены запятой)</span>
                        </label>
                        <input v-model.trim="event.guests" type="text" class="form-control" id="guestsEvent" name="guestsEvent">
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 py-2">
                        <label for="guestsEvent" class="form-label error">
                            Гости <span class="warning">(емейлы гостей должны быть разделены запятой)</span>
                        </label>
                        <input v-model.trim="event.guests" type="text" class="form-control error" id="guestsEvent" name="guestsEvent">
                    </div>
                </template>
                <div class="col-12 py-2">
                    <label for="locationEvent" class="form-label">Место расположения</label>
                    <input v-model.trim="event.location" type="text" class="form-control" id="locationEvent" name="locationEvent">
                </div>
                <template v-if="!errorDescriptionEvent">
                    <div class="col-12 py-2">
                        <label for="descriptionEvent" class="form-label">Описание<span>*</span></label>
                        <input v-model.trim="event.description" type="text" class="form-control" id="descriptionEvent" name="descriptionEvent">
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 py-2">
                        <label for="descriptionEvent" class="form-label">Описание<span class="error">*</span></label>
                        <input v-model.trim="event.description" type="text" class="form-control error" id="descriptionEvent" name="descriptionEvent">
                    </div>
                </template>
                <template v-if="!errorDateStartEvent && !errorTimeStartEvent">
                    <div class="col-4 py-2">
                        <label class="form-label">Начало<span>*</span>:</label>
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <label class="form-label">Начало<span class="error">*</span>:</label>
                    </div>
                </template>
                <template v-if="!errorDateStartEvent">
                    <div class="col-4 py-2">
                        <input v-model.trim="event.dateStart" type="date" class="form-control" id="dateStartEvent" name="dateStartEvent">
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <input v-model.trim="event.dateStart" type="date" class="form-control error" id="dateStartEvent" name="dateStartEvent">
                    </div>
                </template>
                <template v-if="!errorTimeStartEvent">
                    <div class="col-4 py-2">
                        <input v-model.trim="event.timeStart" type="time" class="form-control" id="timeStartEvent" name="timeStartEvent">
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-2">
                        <input v-model.trim="event.timeStart" type="time" class="form-control error" id="timeStartEvent" name="timeStartEvent">
                    </div>
                </template>
                <template v-if="!errorDateEndEvent && !errorTimeEndEvent">
                    <div class="col-4 py-2">
                        <label class="form-label">Окончание<span>*</span>:</label>
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-3">
                        <label class="form-label">Окончание<span class="error">*</span>:</label>
                    </div>
                </template>
                <template v-if="!errorDateEndEvent">
                    <div class="col-4 py-3">
                        <input v-model.trim="event.dateEnd" type="date" class="form-control" id="dateEndEvent" name="dateStartEvent">
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-3">
                        <input v-model.trim="event.dateEnd" type="date" class="form-control error" id="dateEndEvent" name="dateStartEvent">
                    </div>
                </template>
                <template v-if="!errorTimeEndEvent">
                    <div class="col-4 py-3">
                        <input v-model.trim="event.timeEnd" type="time" class="form-control" id="timeEndEvent" name="timeStartEvent">
                    </div>
                </template>
                <template v-else>
                    <div class="col-4 py-3">
                        <input v-model.trim="event.timeEnd" type="time" class="form-control error" id="timeEndEvent" name="timeStartEvent">
                    </div>
                </template>
            </div>
            <div class="row text-center py-3 footer-create-event">
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

    name: "TheEvent",

    data() {
        return {

            isValid: true,
            errorNameEvent: false,
            errorDescriptionEvent: false,
            errorDateStartEvent: false,
            errorTimeStartEvent: false,
            errorDateEndEvent: false,
            errorTimeEndEvent: false,
            errorGuestsEvent: false,

            event: {
                name: this.name,
                guests: this.guests,
                location: this.location,
                description: this.description,
                dateStart: this.dateStart,
                timeStart: this.timeStart,
                dateEnd: this.dateEnd,
                timeEnd: this.timeEnd,
            }
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
        'guests',
        'location',
        'description',
        'dateStart',
        'timeStart',
        'dateEnd',
        'timeEnd',
    ],

    methods: {

        close() {

            //очищаем форму
            // document.getElementById("myForm").reset()
            // не нужно, т.к. тогда збрасывается значение, которое передается в пропсах

            //сбрасываем ошибки
            this.isValid = true
            this.errorNameEvent = false
            this.errorDescriptionEvent = false
            this.errorDateStartEvent = false
            this.errorDateEndEvent = false
            this.errorTimeStartEvent = false
            this.errorTimeStartEvent = false
            this.errorTimeEndEvent = false
            this.errorGuestsEvent = false

            //сбрасываем event
            //если пропсы есть (для редактировния), то поля заполнятся их значениями
            //иначе - поля очистятся
            this.event.name = this.name
            this.event.description = this.description
            this.event.guests = this.guests
            this.event.location = this.location
            this.event.description = this.description
            this.event.dateStart = this.dateStart
            this.event.dateEnd = this.dateEnd
            this.event.timeStart = this.timeStart
            this.event.timeEnd = this.timeEnd

            //прослушиваем событие close в родительском компоненте
            this.$emit('close');
        },

        validation() {

            //сброс значений ошибок
            this.isValid = true
            this.errorNameEvent = false
            this.errorDescriptionEvent = false
            this.errorDateStartEvent = false
            this.errorDateEndEvent = false
            this.errorTimeStartEvent = false
            this.errorTimeStartEvent = false
            this.errorTimeEndEvent = false
            this.errorGuestsEvent = false

            if (!this.event.name) {
                this.errorNameEvent = true
            }
            if (!this.event.description) {
                this.errorDescriptionEvent = true
            }
            if (!this.event.dateStart) {
                this.errorDateStartEvent = true
            }
            if (!this.event.dateEnd) {
                this.errorDateEndEvent = true
            }
            if (!this.event.timeStart) {
                this.errorTimeStartEvent = true
            }
            if (!this.event.timeEnd) {
                this.errorTimeEndEvent = true
            }

            //валидация на мейлы с помощью регулярные выражений в поле Гости
            //шаблон для  одного мейла
            let reqexp = /.+@.+\..+/i //один адрес в поле
            //если поле Гости не пустое
            if (this.event.guests) {
                // разбиваем строку с вводимыми мейлами, шаблон для разделения: сколько угодно пробелов-запятая-сколько угодно пробелов
                let arrGuests = this.event.guests.split(/\s*,\s*/)
                console.log(arrGuests)
                let k = 0
                for (let i=0; i<arrGuests.length; i++) {
                    console.log(arrGuests[i])
                    if ((arrGuests[i]).match(reqexp) !== null) {
                        console.log((arrGuests[i]).match(reqexp))
                        k++
                    }
                }
                if (k === arrGuests.length) {
                    this.errorGuestsEvent = false
                    console.log('мейлы гостей введены верно')
                } else {
                    this.errorGuestsEvent = true
                    console.log('неверно введены мейлы гостей')
                }
            } else {
                this.errorGuestsEvent = false
            }

            if (!this.errorNameEvent && !this.errorDescriptionEvent && !this.errorDateStartEvent && !this.errorDateEndEvent
                && !this.errorTimeStartEvent && !this.errorTimeEndEvent && !this.errorGuestsEvent) {
                this.isValid = true
            } else {
                this.isValid = false
            }

        },

        saveEvent() {

            this.validation()

            if (this.isValid) {

                // console.log(this.event.name)
                // console.log(this.event.description)
                // console.log(this.event.guests)
                // console.log(this.event.location)
                // console.log(this.event.description)
                // console.log(this.event.dateStart)
                // console.log(this.event.dateEnd)
                // console.log(this.event.timeStart)
                // console.log(this.event.timeEnd)

                //прослушиваем событие saveEvent в родительском компоненте и передаем туда объект this.event
                this.$emit('saveEvent', this.event)

                this.$bvModal.show('modal-message-event')

                this.isValid = true

                //сбрасываем event
                //если пропсы есть (для редактировния), то поля заполнятся их значениями
                //иначе - поля очистятся
                this.event.name = this.name
                this.event.description = this.description
                this.event.guests = this.guests
                this.event.location = this.location
                this.event.description = this.description
                this.event.dateStart = this.dateStart
                this.event.dateEnd = this.dateEnd
                this.event.timeStart = this.timeStart
                this.event.timeEnd = this.timeEnd
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

.warning {
    color: darkred;
}

</style>
