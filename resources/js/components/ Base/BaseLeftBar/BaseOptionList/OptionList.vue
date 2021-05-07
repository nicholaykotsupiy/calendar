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
                <ul class="option_list d-flex justify-content-center flex-wrap align-items-center">
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: red" @click="addColors(calendar.option, 'red')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: blue" @click="addColors(calendar.option, 'blue')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: green" @click="addColors(calendar.option, 'green')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: red" @click="addColors(calendar.option, 'red')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: blue" @click="addColors(calendar.option, 'blue')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: green" @click="addColors(calendar.option, 'green')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: red" @click="addColors(calendar.option, 'red')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: blue" @click="addColors(calendar.option, 'blue')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: green" @click="addColors(calendar.option, 'green')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: red" @click="addColors(calendar.option, 'red')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: blue" @click="addColors(calendar.option, 'blue')" class="fake_check"></div>
                        </label>
                    </li>
                    <li class="mx-2">
                        <label>
                            <input type="checkbox" class="checkbox">
                            <div style="background: green" @click="addColors(calendar.option, 'green')" class="fake_check"></div>
                        </label>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</template>

<script>
import arrow from "../../../../assets/img/DayCalendar/arrow_callendars.png";
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
                    active: false,
                    colors: [],
                }
            },
            {
                id: 2,
                name: 'Задачи',
                option: {
                    active: false,
                    colors: [],
                }
            },
            {
                id: 3,
                name: 'Мероприятие',
                option: {
                    active: false,
                    colors: [],
                }
            },
            {
                id: 4,
                name: 'Напоминания',
                option: {
                    active: false,
                    colors: [],
                }
            },
            {
                id: 5,
                name: 'Праздники Украины',
                option: {
                    active: false,
                    colors: [],
                }
            },
        ]
    }),
    methods: {
        openBar(calendar, index) {
            if(calendar.option.active) {
                this.$refs.item[index].style.transform = 'rotate(0deg)'
            } else {
                this.$refs.item[index].style.transform = 'rotate(90deg)'
            }
            calendar.option.active = !calendar.option.active
        },
        addColors(option, color) {
            if(option.colors.indexOf(color) === -1){
                option.colors.push(color)
            } else {
                option.colors.splice(option.colors.indexOf(color), 1)
            }
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
