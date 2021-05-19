<template>
    <div>
        <div class="flex">
            <div>
                <button v-on:click="prevWeek"><</button>
            </div>
            <div>
                <button v-on:click="nextWeek">></button>
            </div>
            <div> {{ switchMonth() }} {{ year }}</div>
        </div>
        <table class="week">
            <tr class="head">
                <th>день</th>
                <th v-for="day in days">
                    <span>{{ day.day_of_week.toUpperCase() }}</span>
                    <span :class="isCurrentDay(day) ? 'today' : ''">{{ day.day_of_month }}</span>

                </th>
            </tr>
            <tr v-for="time in times">
                <td>{{ time.format('HH:mm') }}</td>
                <td v-for="day in days">
                    <!--                    {{ getEventsForThisDateTime(day, time) }}-->
                    <template v-for="event in getEventsForThisDateTime(day, time)">
                        <template v-if="event.type === 'event'">
                            <div class="daygrid-day-event" :id="`event-`+event.id+'-'+day.index">
                                {{ event.name }}
                                <modal-edit
                                    :id="`event-`+event.id+'-'+day.index"
                                    type-event="event"
                                    :id-event="event.id"
                                    :edit-modal-title="event.name"
                                    :edit-modal-time="event.timeStart"
                                >
                                </modal-edit>
                            </div>
                        </template>
                        <template v-if="event.type === 'reminder'">
                            <div class="daygrid-day-reminder" :id="`reminder-`+event.id+'-'+day.index">
                                {{ event.name }}
                                <modal-edit
                                    :id="`reminder-`+event.id+'-'+day.index"
                                    type-event="reminder"
                                    :id-event="event.id"
                                    :edit-modal-title="event.name"
                                    :edit-modal-time="event.timeStart"
                                    :description="event.description"
                                >
                                </modal-edit>
                            </div>
                        </template>
                        <template v-if="event.type === 'task'">
                            <div class="daygrid-day-task" :id="`task-`+event.id+'-'+day.index">
                                {{ event.name }}
                                <modal-edit
                                    :id="`task-`+event.id+'-'+day.index"
                                    type-event="task"
                                    :id-event="event.id"
                                    :edit-modal-title="event.name"
                                    :edit-modal-time="event.timeStart"
                                >
                                </modal-edit>
                            </div>
                        </template>
                        <template v-if="event.type === 'birthday'">
                            <div class="daygrid-day-birthday" :id="`birthday-`+event.id+'-'+day.index">
                                {{ event.name }}
                                <modal-edit
                                    :id="`birthday-`+event.id+'-'+day.index"
                                    type-event="birthday"
                                    :id-event="event.id"
                                    :edit-modal-title="event.name"
                                    :edit-modal-time="event.timeStart"
                                >
                                </modal-edit>
                            </div>
                        </template>
                    </template>
                </td>
            </tr>
        </table>
    </div>
</template>
<script>

import DayCalendarNavigation from "../DayCalendar/DayCalendarComponents/DayCalendarNavigation";
import {mapGetters, mapMutations} from 'vuex'


export default {
    name: "Week",
    components: {DayCalendarNavigation},

    data() {

        return {
            month: new Date().getMonth(),
            year: new Date().getFullYear(),
            dFirstMonth: 1,
            day: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
            months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],

            days: [],
            daysOfCurrentWeek: [],
        }
    },
    computed: {
        allEventsForDay() {
            return this.allEventsForDay
        },
        holidays() {
            return this.holidays
        },
        ...mapGetters([
            'allEventsForDay',
            'holidays',
        ]),
        times() {
            let times = [];

            for (let i = 0; i <= 23; i++) {
                times.push(this.$moment(i, 'hh'));
            }

            return times;
        }
    },
    created() {
        console.log(this.$moment(1, 'hh').format('HH:mm'))
        const startDateOfCurrentWeek = this.$moment().weekday(0);
        const endDateOfCurrentWeek = this.$moment().weekday(6);
        this.daysOfCurrentWeek = this.getDaysBetweenTwoDates(startDateOfCurrentWeek, endDateOfCurrentWeek);
        this.days = this.daysOfCurrentWeek;
    },

    methods: {
        ...mapMutations([
            'prevWeek',
            'nextWeek',

        ]),

        getDaysBetweenTwoDates(startDate, endDate) {
            let now = startDate.clone(), days = [];

            while (now.isSameOrBefore(endDate)) {
                let day = {};
                day.day_of_week = now.format('dddd');
                day.day_of_month = now.format('D');
                day.full_date = now.format();
                days.push(day);
                now.add(1, 'days');
            }
            return days;
        },
        isCurrentDay(day) {
            const currentDate = this.$moment().format('M-D-Y');
            const thisDate = this.$moment(day.full_date).format('M-D-Y');
            if (currentDate === thisDate) {
                return true;
            }
            return false;
        },
        prevWeek() {

            const startDate = this.$moment(this.days[0].full_date).subtract('7', 'days');
            const endDate = this.$moment(this.days[this.days.length - 1].full_date).subtract('7', 'days');
            this.days = this.getDaysBetweenTwoDates(startDate, endDate);


        },
        nextWeek() {
            const startDate = this.$moment(this.days[0].full_date).add('7', 'days');
            const endDate = this.$moment(this.days[this.days.length - 1].full_date).add('7', 'days');
            this.days = this.getDaysBetweenTwoDates(startDate, endDate);

        },
        switchMonth() {
            const newMonth = this.$moment().format('MMMM');
        },
        byField(field) {
            return (a, b) => a[field] > b[field] ? 1 : -1
        },
        getEventsForThisDateTime(date, time) {
            let eventsOfCurrentDate = [];
            const thisDate = this.$moment(date.full_date).format('YYYY-MM-D');
            const thisTime = this.$moment(time).format('HH:mm:ss');
            const eventOfThisDay = _.find(this.allEventsForDay, {'dateStart': thisDate, 'timeStart': thisTime});

            if (eventOfThisDay) {
                console.log(eventOfThisDay)
                eventsOfCurrentDate.push(eventOfThisDay);
            }

            return eventsOfCurrentDate;
        }
    }
}
</script>

<style scoped>

.head td {
    width: 100px;
}

table {
    width: 100%;
    border-collapse: collapse;
    border: 2px solid white;
    color: #B2B2B2;
    left: 26.2%;
    top: 200px;
    background: white;
}

td, th {
    padding: 15px 20px;
    border: 1px solid #B2B2B2;
    text-align: left;
    white-space: nowrap;
    font-weight: 500;
    font-size: 12px;
    line-height: 30px;
    background: white;
    color: #808080;

}
.today{
    background: #1b4b72;
    color: white;
    border-radius: 50%;
}

.flex {
    display: flex;
    align-content: space-between;
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
    /*padding-right: 10px;*/
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
    margin: 2px;
    padding: 5px;
    line-height: 14px;
    cursor: pointer;
    background: #FEEACC;
    border-radius: 4px;
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 12px;
    color: #D46D2C;
    text-align: center;
}

.daygrid-day-task {
    margin: 2px;
    padding: 5px;
    line-height: 14px;
    cursor: pointer;
    font-style: normal;
    font-weight: bold;
    font-size: 12px;
    color: #008911;
    background: #E0F7D7;
    border-radius: 4px;
    text-align: center;
}

.daygrid-day-birthday {
    margin: 2px;
    padding: 5px;
    line-height: 14px;
    cursor: pointer;
    font-style: normal;
    font-weight: bold;
    font-size: 12px;
    color: #2675B5;
    background: #D2EFFE;
    text-align: center;
    border-radius: 4px;
}

.daygrid-day-event {
    margin: 2px;
    padding: 5px;
    line-height: 14px;
    cursor: pointer;
    background: #F5E3F9;
    border-radius: 4px;
    font-weight: bold;
    font-size: 12px;
    color: #86488A;
    text-align: center;
}

</style>

