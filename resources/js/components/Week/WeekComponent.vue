<template>
    <div class="wrap m-2">
        <div class="calendar-center">
            <table class="table">
                <thead>
                    <tr class="head">
                        <th>день</th>
                        <th v-for="day in days">
                            <span>{{ day.day_of_week.toUpperCase() }}</span>
                            <span :class="isCurrentDay(day) ? 'today' : ''">
                                <span :class="dayIsHoliday(day) ? 'daygrid-day-number holiday' : ''"
                                      @click="dayClickHandler(day)">
                                    <router-link
                                        to="/"
                                    :style="{ }">
                                        <span :style="isCurrentDay(day) || dayIsHoliday(day) ? '' : {color: '#808080'}">
                                            {{ day.day_of_month }}
                                        </span>
                                    </router-link>
                                </span>
                            </span>
                            <!--     holiday               -->
                            <template v-if="dayIsHoliday(day)">
                                <div class="daygrid-day-ukr" v-for="holiday in getHolidaysByDay(day)">
                                    {{ holiday.summary}}
                                </div>
                            </template>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="time in times">
                    <td>{{ time.format('HH:mm') }}</td>
                    <td v-for="day in days">

                        <!--                    {{ getEventsForThisDateTime(day, time) }}-->
                        <template v-for="event in allEventsForWeek">
                            <template v-if="isEventDateTime(event, day, time)">
                                <template v-if="event.type === 'event'">
                                    <div class="daygrid-day-event" :id="`event-`+event.id+'-'+day.index">
                                        {{ event.name }}
                                        <edit-modal
                                            :id="`event-`+event.id+'-'+day.index"
                                            :event="event"
                                        >
                                        </edit-modal>
                                    </div>
                                </template>
                                <template v-if="event.type === 'reminder'">
                                    <div class="daygrid-day-reminder" :id="`reminder-`+event.id+'-'+day.index">
                                        {{ event.name }}
                                        <edit-modal
                                            :id="`reminder-`+event.id+'-'+day.index"
                                            :event="event"
                                        >
                                        </edit-modal>
                                    </div>
                                </template>
                                <template v-if="event.type === 'task'">
                                    <div class="daygrid-day-task" :id="`task-`+event.id+'-'+day.index">
                                        {{ event.name }}
                                        <edit-modal
                                            :id="`task-`+event.id+'-'+day.index"
                                            :event="event"
                                        >
                                        </edit-modal>
                                    </div>
                                </template>
                                <template v-if="event.type === 'birthday'">
                                    <div class="daygrid-day-birthday" :id="`birthday-`+event.id+'-'+day.index">
                                        {{ event.name }}
                                        <edit-modal
                                            :id="`birthday-`+event.id+'-'+day.index"
                                            :event="event"
                                        >
                                        </edit-modal>
                                    </div>
                                </template>
                            </template>
                        </template>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>

import DayCalendarNavigation from "../DayCalendar/DayCalendarComponents/DayCalendarNavigation";
import {mapGetters, mapMutations} from 'vuex'
import EditModal from "../Events/Edit/EditModal";

export default {
    name: "Week",
    components: {
        DayCalendarNavigation,
        EditModal,
    },

    data() {

        return {
            dFirstMonth: 1,
            months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            date: new Date(),
            days: [],
            daysOfCurrentWeek: [],
        }
    },
    mounted() {
        this.setIsWeek(true)
        this.setTitleNavigationCalendarWeek(this.months[this.getMonthOfWeek(this.weekCalendarWeek, this.yearCalendarWeek)] + ' ' + this.yearCalendarWeek);
    },
    beforeDestroy() {
        this.setIsWeek(false)
    },
    computed: {
        isWeek() {
            return this.isWeek
        },
        holidays() {
            return this.holidays
        },
        allEventsForWeek() {
            return this.allEventsForDay
        },
        titleNavigationCalendarWeek(state) {
            return state.titleNavigationCalendarWeek
        },
        month() {
            return this.monthCalendarWeek
        },
        year() {
            return this.yearCalendarWeek
        },

        ...mapGetters([
            'isWeek',
            'allEventsForDay',
            'holidays',
            'titleNavigationCalendarWeek',
            'weekCalendarWeek',
            'monthCalendarWeek',
            'yearCalendarWeek',
        ]),
        times() {
            let times = [];

            for (let i = 0; i <= 23; i++) {
                times.push(this.$moment(i, 'hh'));
            }

            return times;
        },
    },
    created() {
        const startDateOfCurrentWeek = this.$moment().year(this.yearCalendarWeek).weekday(0).week(this.weekCalendarWeek);
        const endDateOfCurrentWeek = this.$moment().year(this.yearCalendarWeek).weekday(6).week(this.weekCalendarWeek);
        this.daysOfCurrentWeek = this.getDaysBetweenTwoDates(startDateOfCurrentWeek, endDateOfCurrentWeek);
        this.days = this.daysOfCurrentWeek;
    },

    watch: {
        weekCalendarWeek(week) {
            const startDateOfCurrentWeek = this.$moment().year(this.yearCalendarWeek).weekday(0).week(week);
            const endDateOfCurrentWeek = this.$moment().year(this.yearCalendarWeek).weekday(6).week(week);
            this.daysOfCurrentWeek = this.getDaysBetweenTwoDates(startDateOfCurrentWeek, endDateOfCurrentWeek);
            this.days = this.daysOfCurrentWeek;
        },
    },

    methods: {
        ...mapMutations([
            'setIsWeek',
            'prevWeek',
            'nextWeek',
            'setTitleNavigationCalendarWeek'
        ]),

        getMonthOfWeek(week, year) {
            const date = (1 + (week - 1) * 7);

            return new Date(year, 0, date).getMonth();
        },

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
        isEventDateTime(event, date, time) {
            const thisDate = this.$moment(date.full_date).format('YYYY-MM-D');
            const thisTime = this.$moment(time).format('HH:mm:ss');

            if (event.dateStart === thisDate && event.timeStart === thisTime) {
                return true;
            }

            return false;
        },
        dayIsHoliday(day) {
            const thisDate = this.$moment(day.full_date).format('YYYY-MM-DD');
            if (this.holidays[thisDate]) {
                return true;
            }

            return false;
        },
        getHolidaysByDay(day) {
            const thisDate = this.$moment(day.full_date).format('YYYY-MM-DD');

            return this.holidays[thisDate];
        },
        dayClickHandler(e) {
            let currentDate = new Date()
            this.swichToDate(`${currentDate.getMonth() + 1}/${e.index}/${currentDate.getFullYear()}`)
        },
        capitalizeFirstLetter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
    },
}
</script>

<style scoped>
table {
    width: 100%;
    border-collapse: collapse;
    border: 2px solid white;
    background: white;
}

td, th {
    border: 1px solid #B2B2B2;
    color: #808080;
    font-size: 12px;
    line-height: 30px;
    text-align: center;
    padding: 15px 0px;
    white-space: nowrap;

}
th .daygrid-day-ukr{
    font-weight: bold;
    font-size: 14px;
}
.today {
    color: #3490dc;
    text-decoration: none;
}
a {
    text-decoration: none;
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
.daygrid-day-number a{
    padding-right: 10px;
}

.daygrid-day-number {
    width: 25px;
    text-decoration: none;
}

.holiday {
    /*width: 25px;*/
    /*height: 25px;*/
    color: #ffff;
    background: red;
    border-radius: 3px;
    text-align: center;
    line-height: 24px;
    text-decoration: none;
}
.daygrid-day-ukr {
    width: 100%;
    color: #222222;
    text-align: center;
    padding-left: 5px;
    line-height: 18px;
}

.wrap {
    background: #ffffff;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
    border-radius: 6px;
}
.calendar-center {
    margin: 0 auto;
    padding-top: 30px;
    padding-bottom: 30px;
    overflow: auto;
}

</style>

