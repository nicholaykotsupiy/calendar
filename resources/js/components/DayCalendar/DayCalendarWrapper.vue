<template>
    <div>
        <TopNavigation />
        <DayCalendarNavigation @current="currentDateToDayCalendar" @prev="prevDateToDayCalendar" @next="nextDateToDayCalendar" />
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
import { mapMutations } from 'vuex'
import DayCalendarNavigation from "./DayCalendarComponents/DayCalendarNavigation";
export default {
    name: "DayCalendarWrapper",
    components: {
        DayCalendarNavigation,
        LeftNavigation,
        TopNavigation,
        DayCalendar
    },
    methods: {
        ...mapMutations([
            'prevDateToDayCalendar',
            'nextDateToDayCalendar',
            'currentDateToDayCalendar'
        ])
    }
}
</script>
