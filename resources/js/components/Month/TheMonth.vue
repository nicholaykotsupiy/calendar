<template>

    <div class="container calendar-center">

<!--        убрала -->
<!--        &lt;!&ndash;        временные кнопки&ndash;&gt;-->
<!--        <div class="flex">-->
<!--            <div>-->
<!--                <button v-on:click="prevMonth"><</button>-->
<!--            </div>-->
<!--            <div>-->
<!--                <button v-on:click="nextMonth">></button>-->
<!--            </div>-->
<!--&lt;!&ndash;            <div> {{ titleNavigationCalendarMonth }} </div>&ndash;&gt;-->
<!--            <div> {{months[month]}} {{year}} </div>-->
<!--        </div>-->

        <table class="table-month">
            <thead>
            <tr class="flex">
                <td v-for="d in day">{{d}}</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="week in calendar()" class="flex">
                <td v-for="(day, index) in week">
                    <div class="daygrid-day-frame">
                        <div class="daygrid-day-top flex">

<!--                                пример как будут отображаться праздники Украины-->
                            <template v-if="day.index === 15">
                                <div class="daygrid-day-ukr">Праздник Укр </div>
                                <div class="daygrid-day-number">
<!--                                        обозначить текущий день-->
                                    <a href="#" :style="{
                                        'background': day.currentbg,
                                        'color': day.current,
                                        'border-radius': '50%',
                                        'width': '30px',
                                        'height': '30px',
                                        'padding': '5px'
                                        }">
                                        {{ day.index }}
                                    </a>
                                </div>
                            </template>

                            <template v-else>
                                <div class="daygrid-day-number-without-ukr">
<!--                                        обозначить текущий день-->
                                    <a href="#"
                                       :style="{
                                            'background': day.currentbg,
                                            'color': day.current,
                                            'border-radius': '50%',
                                            'width': '30px',
                                            'height': '30px',
                                            'padding': '5px'
                                        }">
                                        {{ day.index }}
                                    </a>
                                </div>
                            </template>
                        </div>

<!--                            пример напоминалок на один день, взяла 2-е число-->
                        <template v-if="day.index === 2">
                            <div class="daygrid-day-reminder">
                                Напоминание
                            </div>
                            <div class="daygrid-day-task">
                                Задача
                            </div>
                            <div class="daygrid-day-birthday">
                                День рождения
                            </div>
                            <div class="daygrid-day-event">
                                Мероприятие
                            </div>
                        </template>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import DayCalendarNavigation from "../DayCalendar/DayCalendarComponents/DayCalendarNavigation";
import { mapGetters, mapMutations } from 'vuex'

export default {

    name: "TheMont",

    components: {DayCalendarNavigation},

    data() {

        return {
            //перенесла в стейт
            // month: new Date().getMonth(),
            // year: new Date().getFullYear(),
            dFirstMonth: 1,
            day:["Понедельник", "Вторник","Среда","Четверг","Пятница","Суббота", "Воскресенье"],
            // months: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
            date: new Date(),
        }
    },

    computed: {

        isMonth() {
            return this.isMonth
        },

        month() {
            return this.monthCalendarMonth
        },

        months() {
            return this.monthsCalendarMonth
        },

        year() {
            return this.yearCalendarMonth
        },

        titleNavigationCalendarMonth() {
            return this.titleNavigationCalendarMonth
        },

        ...mapGetters([
            'isMonth',
            'monthCalendarMonth',
            'monthsCalendarMonth',
            'yearCalendarMonth',
            'titleNavigationCalendarMonth',
        ])
    },

    mounted() {
        this.setIsMonth(true)
        this.setTitleNavigationCalendarMonth(this.months[this.month]+' '+this.year)
    },

    beforeDestroy() {
        this.setIsMonth(false)
    },

    methods:{

        ...mapMutations([
            'setIsMonth',
            'prevMonth',
            'nextMonth',
            'setTitleNavigationCalendarMonth'
        ]),

        calendar() {

            let days = []
            let week = 0
            days[week] = []
            let dlast = new Date(this.year, this.month + 1, 0).getDate();

            for (let i = 1; i <= dlast; i++) {

                if (new Date(this.year, this.month, i).getDay() !== this.dFirstMonth) {
                    let a = {index:i}
                    days[week].push(a)
                    if (i === new Date().getDate() && this.year === new Date().getFullYear() && this.month === new Date().getMonth())
                    {
                        a.current = '#ffffff'
                        a.currentbg = '#1875F0'
                    }
                }
                else {
                    week++
                    days[week] = []
                    let a = {index:i}
                    days[week].push(a)
                    if ((i === new Date().getDate()) && (this.year === new Date().getFullYear()) && (this.month === new Date().getMonth()))                     {
                        a.current = '#ffffff'
                        a.currentbg = '#1875F0'
                    }
                }

            }

            if (days[0].length > 0) {
                for (let i = days[0].length; i < 7; i++) {
                    days[0].unshift('');
                }
            }

            if (days[week].length > 0) {
                for (let i = days[week].length; i < 7; i++) {
                    days[week].push('');
                }
            }

            // console.log(days);
            // console.log(week);

            return days;

        },

        //тоже вынесла в стейт
        // prevMonth() {
        //
        //     this.month--
        //     if (this.month < 0) {
        //         this.month = 12
        //         this.month--
        //         this.year--
        //     }
        //
        // },
        //
        // nextMonth() {
        //
        //     this.month++
        //     if (this.month > 11) {
        //         this.month = -1
        //         this.month++
        //         this.year++
        //     }
        //
        // },
    },
}
</script>

<style scoped>

.flex {
    display: flex;
    align-content: space-between;
}
.container {
    max-width: 1120px;
    max-height: 780px;
}
.calendar-center {
    margin: 0 auto;
    padding-top: 30px;
    padding-bottom: 30px;
}
.table-month {
    font-family: Roboto;
    width: 100%;
    height: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}
.table-month thead td {
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    line-height: 90px;
    text-align: center;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #B3B3B3;
}
.table-month td {
    width: 14.286%;
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 14px;
    line-height: 30px;
    text-align: right;
    min-height: 90px;
    vertical-align: top;
    padding-right: 10px;
    color: #CCCCCC;
    border: 1px solid #F5F5F5;
}
.daygrid-day-number a, .daygrid-day-number-without-ukr a {
    cursor: pointer;
    color: inherit;
    text-decoration: none;
    padding-left: 10px;
}
.daygrid-day-reminder {
    margin: 1px;
    cursor: pointer;
    background: #FEEACC;
    border-radius: 4px;
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 12px;
    line-height: 30px;
    color: #D46D2C;
    text-align: center;
}
.daygrid-day-ukr {
    cursor: pointer;
    width: 100%;
    color: #222222;
    text-align: left;
    padding-left: 5px;
}
.daygrid-day-number {
    width: 20px;
}
.daygrid-day-number-without-ukr {
    width: 100%;
}
.daygrid-day-task {
    margin: 1px;
    cursor: pointer;
    font-style: normal;
    font-weight: bold;
    font-size: 12px;
    line-height: 30px;
    color: #008911;
    background: #E0F7D7;
    border-radius: 4px;
    text-align: center;
}
.daygrid-day-birthday {
    margin: 1px;
    cursor: pointer;
    font-style: normal;
    font-weight: bold;
    font-size: 12px;
    line-height: 30px;
    color: #2675B5;
    background: #D2EFFE;
    text-align: center;
    border-radius: 4px;
}
.daygrid-day-event {
    margin: 1px;
    cursor: pointer;
    background: #F5E3F9;
    border-radius: 4px;
    font-weight: bold;
    font-size: 12px;
    line-height: 30px;
    color: #86488A;
    text-align: center;
}

</style>
