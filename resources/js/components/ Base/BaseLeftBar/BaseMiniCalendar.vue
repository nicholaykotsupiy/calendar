<template>
<!--    <b-calendar v-model="value" locale="ru"></b-calendar>-->
    <div class="calendar-year flex">
        <div v-for="(month, monthIndex) in calendar" :key="monthIndex" class="month-lisst">
            <div class="month-name">
                {{ months[currentDate.getMonth()] }} {{ currentDate.getFullYear() }}
            </div>
            <table>
                <tbody>
                <div class="table-month">
                    <tr>
                        <td v-for="(d, dIndex) in day" :key="dIndex">{{ d }}</td>
                    </tr>

                    <tr v-for="(week, weekIndex) in month" :key="weekIndex">
                        <td v-for="(day, dayIndex) in week" :key="dayIndex">
                            <div class="daygrid-day-frame">
                                <div class="daygrid-day-top flex">
                                    <div class="daygrid-day-number-without-ukr" @click="dayClickHandler(day)">
                                        <!--обозначить текущий день-->
                                        <router-link
                                            to="/"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            :title="day.summary"
                                            :style="{
                                                        'background': getDayBgColor(day),
                                                        'color': getDayColor(day),
                                                        'border-radius': '50%',
                                                        'width': '30px',
                                                        'height': '30px',
                                                        'padding': day.index < 10 ? '5px 8px' : '5px'
                                                    }">
                                            {{ day.index }}
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </div>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

import {mapGetters, mapMutations} from "vuex";

export default {
    name: "BaseMiniCalendar",
    data: () => ({
        firstDayOfWeek: 1, // начало недели в Пн
        day:["Пн", "Вт","Ср","Чт","Пт","Сб", "Вс"],
        months: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
        date: null,
        holidays: {},
    }),
    computed: {
        ...mapGetters([
            'currentDate'
        ]),
        calendar() {
            console.log()
            let year = []
            year.push(this.getMonth(this.currentDate.getMonth(), this.currentDate.getFullYear()))
            return year
        },
    },
    methods:{
        ...mapMutations([
            'swichToDate'
        ]),
        getMonth(month, year){
            let days = []
            let week = 0
            days[week] = []
            let lastDayOfMonth = new Date(year, month + 1, 0).getDate();
            for (let i = 1; i <= lastDayOfMonth; i++) {
                let dayOfMonthDateObj = new Date(year, month, i)
                //формирование недель месяца
                if (dayOfMonthDateObj.getDay() === this.firstDayOfWeek && i !== 1) {
                    week++
                    days[week] = []
                }
                let a = {
                    index:i,
                    isHoliday: false,
                    summary: '',
                    isCurrent: false,
                }
                let yyyymmdd = function(dateObj) {
                    var mm = dateObj.getMonth() + 1; // getMonth() is zero-based
                    var dd = dateObj.getDate();

                    return [dateObj.getFullYear(),
                        (mm>9 ? '' : '0') + mm,
                        (dd>9 ? '' : '0') + dd
                    ].join('-');
                };
                function capitalizeFirstLetter(string) {
                    return string.charAt(0).toUpperCase() + string.slice(1);
                }
                let dayOfMonthIsoDate = yyyymmdd(dayOfMonthDateObj)
                //проверка что день праздничный
                if (dayOfMonthIsoDate in this.holidays) {
                    a.isHoliday = true
                    for (let j = 0; j < this.holidays[dayOfMonthIsoDate].length; j++) {
                        a.summary += capitalizeFirstLetter(this.holidays[dayOfMonthIsoDate][j].summary + '. ')
                    }

                }

                // проверка на текущий день
                if (i === this.currentDate.getDate() && year === this.currentDate.getFullYear() && month === this.currentDate.getMonth())
                {
                    a.isCurrent = true
                }

                days[week].push(a)
            }

            for (let i = days[0].length; i < 7; i++) {
                days[0].unshift('');
            }
            for (let i = days[week].length; i < 7; i++) {
                days[week].push('');
            }

            return days;
        },
        dayClickHandler(e) {
            this.swichToDate(`${this.currentDate.getMonth()+1}/${e.index}/${this.currentDate.getFullYear()}`)
        },
        getDayBgColor(day) {
            if (day.isCurrent) {
                return '#1875f0'
            }
            if (day.isHoliday) {
                return '#fbdddd'
            }
            return '#ffffff'
        },
        getDayColor(day) {
            if (day.isCurrent) {
                return '#ffffff'
            }
            if (day.isHoliday) {
                return '#f44336'
            }
            return '#666666'
        },
    },
}
</script>

<style scoped>
.flex {
    display: flex;
    align-content: space-between;
    flex-wrap: wrap;
}
.container {
    max-width: 1120px;
    max-height: 780px;
}
.calendar-center {
    margin: 0 auto;
    padding-top: 30px;
    padding-bottom: 30px;
    font-size: 14px;
    font-family: Roboto;
    font-weight: 500;
    font-style: normal;
    color: #666666;
}
.month-lisst {
    margin-right: 5px;
    margin-bottom: 5px;
    background-color: #ffffff;
}
.month-name {
    padding: 10px 20px;
    border-bottom: 3px solid rgb(245, 245, 245);
    font-weight: 600;
    font-size: 15px;
    text-align: center;
    color: #666666;
}
.table-month {
    padding-left: 10px;
    padding-top: 10px;
    padding-right: 20px;
    padding-bottom: 15px;
}
.daygrid-day-number a, .daygrid-day-number-without-ukr a {
    cursor: pointer;
    color: inherit;
    text-decoration: none;
    padding-left: 10px;
}
.daygrid-day-frame {
    padding: 3px;
}
</style>
