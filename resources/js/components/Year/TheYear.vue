<template>
    <div class="container calendar-center">

        <!--временные кнопки-->
        <div class="flex">
            <div>
                <button v-on:click="decrease"><</button>
            </div>
            <div>
                <button v-on:click="increase">></button>
            </div>
            <div>{{ currentYear }}</div>
        </div>

        <div class="calendar-year flex">
            <div v-for="(month, monthIndex) in calendar" :key="monthIndex" class="month-lisst">
                <div class="month-name">
                    {{ months[monthIndex] }}
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
                                            <div class="daygrid-day-number-without-ukr">
                                                <!--обозначить текущий день-->
                                                <a
                                                    @click="dayClickHandler(day)"
                                                    :style="{
                                                        'background': getDayBgColor(day),
                                                        'color': getDayColor(day),
                                                        'border-radius': '50%',
                                                        'width': '30px',
                                                        'height': '30px',
                                                        'padding': day.index < 10 ? '5px 8px' : '5px'
                                                    }"> 
                                                    {{ day.index }}
                                                </a>
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
    </div>
</template>

<script>
export default {
    name: "TheYear",
    data() {
        return {
            currentMonth: new Date().getMonth(),
            currentYear: new Date().getFullYear(),
            firstDayOfWeek: 1, // начало недели в Пн
            day:["Пн", "Вт","Ср","Чт","Пт","Сб", "Вс"],
            months: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
            date: new Date(),
            holidays: {},
        }
    },
    mounted() {
        axios
            .get('https://www.googleapis.com/calendar/v3/calendars/ru.ukrainian%23holiday%40group.v.calendar.google.com/events?key=AIzaSyCXtY_r4WvIlu_2N_iVZC8WTc_iXDkZMGM')
            .then(response => {
                let holidays = {};
                for (let i = 0; i < response.data.items.length; i++) {
                    let day = response.data.items[i].start.date
                    if (!(day in holidays)) {
                        holidays[day] = []
                    }
                    holidays[day].push(response.data.items[i])
                }
                this.holidays = holidays
            });
    },
    computed: {
        calendar() {
            let year = []
            for (let i = 0; i <= 11; i++) {
                year.push(this.getMonth(i, this.currentYear))
            }
            return year
        },
    },
    methods:{
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
                    isCurrent: false,
                }
                days[week].push(a)
                let dayOfMonthIsoDate = dayOfMonthDateObj.toISOString().substring(0, 10)
                //проверка что день праздничный
                if (dayOfMonthIsoDate in this.holidays) {
                    a.isHoliday = true
                }

                // проверка на текущий день
                if (i === new Date().getDate() && year === new Date().getFullYear() && month === new Date().getMonth())
                {
                    a.isCurrent = true
                }
            }

            for (let i = days[0].length; i < 7; i++) {
                days[0].unshift('');
            }
            for (let i = days[week].length; i < 7; i++) {
                days[week].push('');
            }
            
            return days;
        },
        decrease() {
            this.currentYear--
        },
        increase() {
            this.currentYear++
        },
        dayClickHandler(e) {
            console.log(e)
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
        padding: 10px 15px;
        border-bottom: 3px solid rgb(245, 245, 245);
    }
    .table-month {
        padding-left: 5px;
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
</style>