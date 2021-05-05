<template>
    <div>
        <TopNavigation />
<!--        если выбран календарь в масштабе месяц -->
        <template v-if="isMonth">
            <DayCalendarNavigation @current="switchToCurrentMonth" @prev="prevMonth" @next="nextMonth" />
        </template>
<!--        если выбран календарь в масштабе неделя -->
<!--        <template v-if="">-->
<!--            <DayCalendarNavigation @current="" @prev="" @next="" />-->
<!--        </template>-->
<!--        если выбран календарь в масштабе год -->
<!--        <template v-if="">-->
<!--            <DayCalendarNavigation @current="" @prev="" @next="" />-->
<!--        </template>-->
<!--        если выбран календарь в масштабе день-->
        <template v-else>
            <DayCalendarNavigation @current="switchToCurrentDate" @prev="prevDate" @next="nextDate" />
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

export default {

    name: "DayCalendarWrapper",

    components: {
        DayCalendarNavigation,
        LeftNavigation,
        TopNavigation,
        DayCalendar
    },

    computed: {

        isMonth() {
            return this.isMonth
        },

        ...mapGetters([
            'isMonth',
        ])
    },

    methods: {

        ...mapMutations([
            'switchToCurrentDate',
            'prevDate',
            'nextDate',
            'prevMonth',
            'nextMonth',
            'switchToCurrentMonth',
        ])
    }
}
</script>
