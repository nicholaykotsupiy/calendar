<template>
    <div class="col-11">
        <BaseHeaderCalendar @open="openLeftBar" class="border-xl-bottom border-xl-3 mb-xl-3" />
        <div class="row">
            <div v-if="open" class="col-6 mx-auto mx-xl-0 col-xl-3">
                <BaseLeftBarCalendar class="left_bar"/>
            </div>
            <div class="col-xl-9 mx-auto">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import BaseHeaderCalendar from "../ Base/BaseTopBar/BaseHeaderCalendar";
import BaseLeftBarCalendar from "../ Base/BaseLeftBar/BaseLeftBarCalendar";
import DayCalendarInterface from "./DayCalendarInterface";
import TheYear from "../Year/TheYear";
import TheMonth from "../Month/TheMonth";
import WeekComponent from "../Week/WeekComponent";
export default {
    name: "DayCalendar",
    components: {
        DayCalendarInterface,
        BaseLeftBarCalendar,
        BaseHeaderCalendar,
        TheMonth,
        WeekComponent,
        TheYear,
    },
    data: () => ({
        open: true,
    }),
    methods: {
        openLeftBar() {
            this.open = !this.open
        },
    }
}
</script>
