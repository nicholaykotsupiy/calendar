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
                                                        'background': day.currentbg,
                                                        'color': day.curcurrentYearrent,
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
        }
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
                if (new Date(year, month, i).getDay() === this.firstDayOfWeek && i !== 1) {
                    week++
                    days[week] = []
                }
                let a = {index:i}
                days[week].push(a)
                // проверка на текущий день
                if (i === new Date().getDate() && year === new Date().getFullYear() && month === new Date().getMonth())
                {
                    a.current = '#ffffff'
                    a.currentbg = '#1875F0'
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