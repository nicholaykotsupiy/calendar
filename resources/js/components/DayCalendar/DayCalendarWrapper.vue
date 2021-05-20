<template>
    <div>
<!--        <TopNavigation />-->
        <Header />
<!--        если выбран календарь в масштабе месяц -->
        <template v-if="isMonth">
            <DayCalendarNavigation @current="switchToCurrentMonth" @prev="prevMonth" @next="nextMonth" />
        </template>
<!--        если выбран календарь в масштабе неделя -->
        <template v-else-if="isWeek">
            <DayCalendarNavigation @current="switchToCurrentWeek" @prev="prevWeek" @next="nextWeek" />
        </template>
<!--        если выбран календарь в масштабе год -->
        <template v-else-if="isYear">
            <DayCalendarNavigation @current="switchToCurrentYear" @prev="prevYear" @next="nextYear" />
        </template>
<!--        если выбран календарь в масштабе день-->
        <template v-else>
            <DayCalendarNavigation @current="currentDateToDayCalendar" @prev="prevDateToDayCalendar" @next="nextDateToDayCalendar" />
        </template>
        <div class="container-fluid">
            <div class="row">
                <LeftNavigation />
                <DayCalendar />
            </div>
        </div>
    </div>
</template>

<script>
import TopNavigation from "../Navigation/TopNavigationBar/TopNavigation"
import LeftNavigation from "../Navigation/LeftNavigationBar/LeftNavigation"
import DayCalendar from  "./DayCalendar"
import { mapGetters, mapMutations } from 'vuex'
import DayCalendarNavigation from "./DayCalendarComponents/DayCalendarNavigation";
import Header from "../Navigation/TopNavigationBar/Header";

export default {

    name: "DayCalendarWrapper",

    components: {
        Header,
        DayCalendarNavigation,
        LeftNavigation,
        TopNavigation,
        DayCalendar
    },

    computed: {

        isMonth() {
            return this.isMonth
        },

        isYear() {
            return this.isYear
        },

        isWeek() {
            return this.isWeek
        },

        ...mapGetters([
            'isMonth',
            'isYear',
            'isWeek'
        ])
    },

    methods: {

        ...mapMutations([
            'prevDateToDayCalendar',
            'nextDateToDayCalendar',
            'currentDateToDayCalendar',
            'prevMonth',
            'nextMonth',
            'switchToCurrentMonth',
            'switchToCurrentYear',
            'nextYear',
            'prevYear',
            'nextWeek',
            'prevWeek',
            'switchToCurrentWeek'
        ])
    }
}
</script>
