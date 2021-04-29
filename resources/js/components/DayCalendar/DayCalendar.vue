<template>
    <div class="col">
        <BaseHeaderCalendar @open="openLeftBar" class="border-bottom border-3 mb-3" />
        <div class="row">
            <div v-if="open" class="col-3">
                <BaseLeftBarCalendar class="left_bar"/>
            </div>
            <div class="col-8">
                <DayCalendarInterface />
            </div>
        </div>
    </div>
</template>

<script>
import BaseHeaderCalendar from "../ Base/BaseTopBar/BaseHeaderCalendar";
import BaseLeftBarCalendar from "../ Base/BaseLeftBar/BaseLeftBarCalendar";
import DayCalendarInterface from "./DayCalendarInterface";
export default {
    name: "DayCalendar",
    components: {DayCalendarInterface, BaseLeftBarCalendar, BaseHeaderCalendar},
    data: () => ({
        open: true
    }),
    methods: {
        openLeftBar() {
            this.open = !this.open
        }
    }
}
</script>
