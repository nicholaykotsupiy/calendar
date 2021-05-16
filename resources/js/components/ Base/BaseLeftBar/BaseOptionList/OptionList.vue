<template>
    <ul v-if="openCalendars" class="calendar_list">
        <li class="list_item" v-for="(calendar, index) in calendars" :key="calendar.id">
            <div @click="openBar(calendar,index)" class="d-flex justify-content-between align-items-center">
                <div>
                    <input type="checkbox" name="calendar">
                    <span>{{ calendar.name }}</span>
                </div>
                <img ref="item" :src="arrow" alt="arrow">
            </div>
            <div v-if="calendar.option.active">
                <div class="option_title">Показывать только этот</div>
                <form>
                    <ul class="option_list d-flex justify-content-center flex-wrap align-items-center">
                        <li class="mx-2">
                            <label>
                                <input type="radio" name="color" class="checkbox">
                                <div style="background: #808080" @click="addColors({type: calendar.option.type, main_color: '#808080',bg_color: '#FAFAFA'})" class="fake_check"></div>
                            </label>
                        </li>
                        <li class="mx-2">
                            <label>
                                <input type="radio" name="color" class="checkbox">
                                <div style="background: #86488A" @click="addColors({type: calendar.option.type, main_color: '#86488A',bg_color: '#F5E3F9'})" class="fake_check"></div>
                            </label>
                        </li>
                        <li class="mx-2">
                            <label>
                                <input type="radio" name="color" class="checkbox">
                                <div style="background: #D46D2C" @click="addColors({type: calendar.option.type, main_color: '#D46D2C',bg_color: '#FEEACC'})" class="fake_check"></div>
                            </label>
                        </li>
                        <li class="mx-2">
                            <label>
                                <input type="radio" name="color" class="checkbox">
                                <div style="background: #008911" @click="addColors({type: calendar.option.type, main_color: '#E0F7D7',bg_color: '#008911'})" class="fake_check"></div>
                            </label>
                        </li>
                        <li class="mx-2">
                            <label>
                                <input type="radio" name="color" class="checkbox">
                                <div style="background: #2675B5" @click="addColors({type: calendar.option.type, main_color: '#2675B5',bg_color: '#D2EFFE'})" class="fake_check"></div>
                            </label>
                        </li>
                    </ul>
                </form>
            </div>
        </li>
    </ul>
</template>

<script>
import arrow from "../../../../assets/img/DayCalendar/arrow_callendars.png";
import {mapActions} from "vuex";
export default {
    name: "OptionList",
    props: ['openCalendars'],
    data: () => ({
        arrow,
        calendars: [
            {
                id: 1,
                name: 'Дни рождения',
                option: {
                    type: 'birthday',
                    active: false,
                }
            },
            {
                id: 2,
                name: 'Задачи',
                option: {
                    type: 'task',
                    active: false,
                }
            },
            {
                id: 3,
                name: 'Мероприятие',
                option: {
                    type: 'event',
                    active: false,
                }
            },
            {
                id: 4,
                name: 'Напоминания',
                option: {
                    type: 'reminder',
                    active: false,
                }
            },
        ]
    }),
    methods: {
        ...mapActions([
            'updateColors'
        ]),
        openBar(calendar, index) {
            if(calendar.option.active) {
                this.$refs.item[index].style.transform = 'rotate(0deg)'
            } else {
                this.$refs.item[index].style.transform = 'rotate(90deg)'
            }
            calendar.option.active = !calendar.option.active
        },
        addColors(option) {
            this.updateColors(option)
        }
    }
}
</script>

<style scoped>
    *,body {
        font-family: Roboto;
    }
    ul, li {
        padding: 0;
        list-style: none;
    }
    .list_item input {
        margin-left: 2px;
        transform:scale(1.3);
    }
    .list_item span{
        font-weight: 500;
        font-size: 13px;
        line-height: 30px;
        color: #808080;
        padding-left: 22px;
    }
    .option_title {
        font-weight: 500;
        font-size: 13px;
        line-height: 30px;
        color: #5a5a5a;
        text-align: center;
        border-bottom: 2px solid #DADADA;
        margin-bottom: 22px;
    }
    .option_list {
        max-width: 90%;
    }
    .checkbox {
        display: none;
    }
    .fake_check {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        position: relative;
        cursor: pointer;
    }
    .fake_check:before {
        content: '';
        position: absolute;
        width: 15px;
        height: 15px;
        background-image: url('../../../../assets/img/DayCalendar/check.svg');
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        opacity: 0;
        transition: .1s;
    }
    .checkbox:checked + .fake_check:before {
        opacity: 1;
    }
</style>
