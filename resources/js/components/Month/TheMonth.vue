<template>
    <div class="container calendar-center">
        <table class="table-month">
            <thead>
            <tr class="flex">
                <td v-for="d in day">{{d}}</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="week in calendar()" class="flex">
                <td v-for="(day, index) in week"                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               >
                    <div class="daygrid-day-frame">
                        <div class="daygrid-day-top flex">

<!--                                праздники Украины-->
<!--                            <template v-for="holiday in holidaysForCurrentMonth()">-->
<!--                                <template v-if="day.index === holiday.day">-->
                            <template v-if="day.index === 9">
                                <div class="daygrid-day-ukr">Праздник Укр</div>
<!--                                    <div class="daygrid-day-ukr">{{ holiday.summary }}</div>-->

                                <div class="daygrid-day-number holiday">
                                    {{ day.index }}
                                </div>
                            </template>


                            <template v-else>
                                <div class="daygrid-day-number-without-ukr">
<!--                                        обозначить текущий день-->
                                    <div :style="{ 'color': day.current }" >
                                        {{ day.index }}
                                    </div>
                                </div>
                            </template>

<!--                            </template>-->
                        </div>

                        <!--                        события -->
                        <template v-for="event in eventsForCurrentMonth()">
                            <template v-if="day.index === event.day">
                                <template v-if="event.type === 'event'">
                                    <div class="daygrid-day-event" :id="`event-`+event.id+'-'+day.index">
                                        {{ event.id }} {{ event.name }}
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
            dFirstMonth: 1,
            day: ["понедельник", "вторник", "среда", "четверг", "пятница", "суббота", "воскресенье"],
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
        allEventsForDay() {
            return this.allEventsForDay
        },

        holidays() {
            return this.holidays
        },

        ...mapGetters([
            'isMonth',
            'monthCalendarMonth',
            'monthsCalendarMonth',
            'yearCalendarMonth',
            'titleNavigationCalendarMonth',
            'allEventsForDay',
            'holidays',
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
            'setTitleNavigationCalendarMonth',
        ]),

        //сортировка
        byField(field) {
            return (a, b) => a[field] > b[field] ? 1 : -1
        },

        holidaysForCurrentMonth() {

            let holidaysForThisMonth = []

            for (let holidaysForDay of this.holidays) {
                console.log(holidaysForDay)

                // let dateArray = holidaysForDay.start.date.split('-')

                // if ( +dateArray[1] === this.month+1 && +dateArray[0] === this.year) {
                //
                //     let cloneHolidaysForDay = {}
                //
                //     for (let key in holidaysForDay) {
                //         cloneHolidaysForDay[key] = holidaysForDay[key]
                //     }
                //
                //     cloneHolidaysForDay.day = +dateArray[2]
                //     holidaysForThisMonth.push(cloneHolidaysForDay)
                // }
            }

            // console.log(holidaysForThisMonth)
            // return holidaysForThisMonth
            return this.holidays
        },

        eventsForCurrentMonth() {

            let eventsForThisMonth = []

            for (let eventForDay of this.allEventsForDay) {

                if (eventForDay.type === "reminder" &&
                    typeof eventForDay["repeat"] !== "undefined" &&
                    eventForDay["repeat"] === "ежедневно") {

                    for (let i = 0; i < 31; i++) {
                        let cloneEventForDay = {}
                        for (let key in eventForDay) {
                            cloneEventForDay[key] = eventForDay[key]
                        }
                        cloneEventForDay.day = i + 1
                        eventsForThisMonth.push(cloneEventForDay)
                    }

                }
            }

            for (let eventForDay of this.allEventsForDay) {
                for (let longsDateItem of eventForDay.longsDate) {

                    let longsDateItemArray = longsDateItem.split('-')
                    // longDateItem = '2021-05-12'
                    // longsDateItemArray[0] = '2021'
                    // longsDateItemArray[1] = '05'
                    // longsDateItemArray[2] = '12'
                    if ( +longsDateItemArray[1] === this.month+1 &&
                        (+longsDateItemArray[0] === this.year ||
                            (typeof eventForDay.everyYear !== "undefined" && eventForDay.everyYear) ||
                            (typeof eventForDay["repeat"] !== "undefined" && eventForDay["repeat"] === "каждый год") ) &&
                        !(eventForDay.type === "reminder" &&
                            typeof eventForDay["repeat"] !== "undefined" &&
                            eventForDay["repeat"] === "ежедневно")
                    ) {

                        let cloneEventForDay = {}

                        for (let key in eventForDay) {
                            cloneEventForDay[key] = eventForDay[key]
                        }

                        cloneEventForDay.day = +longsDateItemArray[2]
                        eventsForThisMonth.push(cloneEventForDay)
                    }
                }
            }

            //отсортировать события по номеру дня
            // eventsForThisMonth.sort(this.byField('day'));
            //отсортировать события по времени начала
            eventsForThisMonth.sort(this.byField('timeStart'));

            return eventsForThisMonth
        },

        calendar() {

            let days = []
            let week = 0
            days[week] = []
            let dlast = new Date(this.year, this.month + 1, 0).getDate();

            for (let i = 1; i <= dlast; i++) {

                if (new Date(this.year, this.month, i).getDay() !== this.dFirstMonth) {
                    let a = {index:i}
                    // this.count++
                    days[week].push(a)
                    if (i === new Date().getDate() && this.year === new Date().getFullYear() && this.month === new Date().getMonth())
                    {
                        a.current = '#3490dc'
                        // a.currentbg = '#ffffff'
                    }
                }
                else {
                    week++
                    days[week] = []
                    let a = {index:i}
                    // this.count++
                    days[week].push(a)
                    if ((i === new Date().getDate()) && (this.year === new Date().getFullYear()) && (this.month === new Date().getMonth()))                     {
                        a.current = '#3490dc'
                        // a.currentbg = '#ffffff'
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
            // console.log(days[week]);

            return days;
        },

    },
}
</script>

<style scoped>

.holiday {
    display: block;
    width: 25px;
    height: 25px;
    background: red;
    border-radius: 3px;
    padding: 0;
    color: #ffff;
    text-align: center;
    line-height: 24px;
}

.currentDay{
    background: #ffffff;
    color: #1875F0;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    padding: 5px;
}

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

.daygrid-day-number {
    width: 30px;
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
.daygrid-day-ukr {
    cursor: pointer;
    width: 100%;
    color: #222222;
    text-align: left;
    padding-left: 5px;
}
.daygrid-day-number-without-ukr {
    width: 100%;
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

.daygrid-day-top {
    padding-right: 5px;
    padding-left: 5px;
}

</style>
