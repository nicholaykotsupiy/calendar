<template>
    <transition name="window-fade">
        <div class="content-create-event-window">
            <div class="backdrop-create-event-window">
                <div class="create-event-window">
                    <form class="create-event" id="myForm" @submit.prevent="saveEvent()">
                        <div class="row justify-content-between g-3 header-create-event">
                            <div class="col-md-11">
                                <div class="row text-center g-3">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary">Мероприятие</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-outline-primary">Напоминание</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-outline-primary">Задача</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-outline-primary">День рождения</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 button-close">
                                <button type="button" class="btn-close" aria-label="Close" @click="close"></button>
                            </div>
                        </div>
                        <div class="row body-create-event">
                            <div v-show="!isValid" class="col-12 error-title">
                                <div class="form-label">Заполните все обязательные поля</div>
                            </div>
                            <template v-if="!errorNameEvent">
                                <div class="col-12">
                                    <label for="nameEvent" class="form-label">Название<span>*</span></label>
                                    <input v-model="event.name" type="text" class="form-control" id="nameEvent" name="nameEvent">
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-12">
                                    <label for="nameEvent" class="form-label">Название<span class="error">*</span></label>
                                    <input v-model="event.name" type="text" class="form-control error" id="nameEvent" name="nameEvent">
                                </div>
                            </template>
                            <div class="col-12 g-3">
                                <label for="guestsEvent" class="form-label">Гости</label>
                                <input v-model="event.guests" type="text" class="form-control" id="guestsEvent" name="guestsEvent">
                            </div>
                            <div class="col-12 g-3">
                                <label for="locationEvent" class="form-label">Место расположения</label>
                                <input v-model="event.location" type="text" class="form-control" id="locationEvent" name="locationEvent">
                            </div>
                            <template v-if="!errorDescriptionEvent">
                                <div class="col-12 g-3">
                                    <label for="descriptionEvent" class="form-label">Описание<span>*</span></label>
                                    <input v-model="event.description" type="text" class="form-control" id="descriptionEvent" name="descriptionEvent">
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-12 g-3">
                                    <label for="descriptionEvent" class="form-label">Описание<span class="error">*</span></label>
                                    <input v-model="event.description" type="text" class="form-control error" id="descriptionEvent" name="descriptionEvent">
                                </div>
                            </template>
                            <template v-if="!errorDateStartEvent && !errorTimeStartEvent">
                                <div class="col-4 g-3">
                                    <label class="form-label">Начало<span>*</span>:</label>
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-4 g-3">
                                    <label class="form-label">Начало<span class="error">*</span>:</label>
                                </div>
                            </template>
                            <template v-if="!errorDateStartEvent">
                                <div class="col-4 g-3">
                                    <input v-model="event.dateStart" type="date" class="form-control" id="dateStartEvent" name="dateStartEvent">
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-4 g-3">
                                    <input v-model="event.dateStart" type="date" class="form-control error" id="dateStartEvent" name="dateStartEvent">
                                </div>
                            </template>
                            <template v-if="!errorTimeStartEvent">
                                <div class="col-4 g-3">
                                    <input v-model="event.timeStart" type="time" class="form-control" id="timeStartEvent" name="timeStartEvent">
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-4 g-3">
                                    <input v-model="event.timeStart" type="time" class="form-control error" id="timeStartEvent" name="timeStartEvent">
                                </div>
                            </template>

                            <template v-if="!errorDateEndEvent && !errorTimeEndEvent">
                                <div class="col-4 g-3">
                                    <label class="form-label">Окончание<span>*</span>:</label>
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-4 g-3">
                                    <label class="form-label">Окончание<span class="error">*</span>:</label>
                                </div>
                            </template>
                            <template v-if="!errorDateEndEvent">
                                <div class="col-4 g-3">
                                    <input v-model="event.dateEnd" type="date" class="form-control" id="dateEndEvent" name="dateStartEvent">
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-4 g-3">
                                    <input v-model="event.dateEnd" type="date" class="form-control error" id="dateEndEvent" name="dateStartEvent">
                                </div>
                            </template>
                            <template v-if="!errorTimeEndEvent">
                                <div class="col-4 g-3">
                                    <input v-model="event.timeEnd" type="time" class="form-control" id="timeEndEvent" name="timeStartEvent">
                                </div>
                            </template>
                            <template v-else>
                                <div class="col-4 g-3">
                                    <input v-model="event.timeEnd" type="time" class="form-control error" id="timeEndEvent" name="timeStartEvent">
                                </div>
                            </template>
                        </div>
                        <div class="row text-center g-3 footer-create-event">
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
    name: "CreateEvent",
    data() {
        return {
            isValid: true,
            errorNameEvent: false,
            errorDescriptionEvent: false,
            errorDateStartEvent: false,
            errorTimeStartEvent: false,
            errorDateEndEvent: false,
            errorTimeEndEvent: false,
            event: {
                name: '',
                guests: '',
                location: '',
                description: '',
                dateStart: '',
                timeStart: '',
                dateEnd: '',
                timeEnd: '',
            }
        }
    },
    methods: {
        close() {
            //очищаем форму
            document.getElementById("myForm").reset()
            //сбрасываем ошибки
            this.isValid = true
            this.errorNameEvent = false
            this.errorDescriptionEvent = false
            this.errorDateStartEvent = false
            this.errorDateEndEvent = false
            this.errorTimeStartEvent = false
            this.errorTimeStartEvent = false
            this.errorTimeEndEvent = false
            //очищаем event
            this.event.name = ''
            this.event.description = ''
            this.event.guests = ''
            this.event.location = ''
            this.event.description = ''
            this.event.dateStart = ''
            this.event.dateEnd = ''
            this.event.timeStart = ''
            this.event.timeEnd = ''
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
            if (!this.errorNameEvent && !this.errorDescriptionEvent && !this.errorDateStartEvent && !this.errorDateEndEvent
                && !this.errorTimeStartEvent && !this.errorTimeEndEvent) {
                this.isValid = true
            } else {
                this.isValid = false
            }
        },
        saveEvent() {
            this.validation()
            //console.log(this.isValid)
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
                //прослушиваем событие saveEvent в родительском компоненте
                this.$emit('saveEvent')
                //очищаем форму
                document.getElementById("myForm").reset()
                this.isValid = true
                //очищаем event
                this.event.name = ''
                this.event.description = ''
                this.event.guests = ''
                this.event.location = ''
                this.event.description = ''
                this.event.dateStart = ''
                this.event.dateEnd = ''
                this.event.timeStart = ''
                this.event.timeEnd = ''
            }
        },
    },
}
</script>



<style scoped>
/*поплыли стили в чужих компонетах, надо переделывать стили для этого компонента*/
/*@import "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css";*/
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
</style>
