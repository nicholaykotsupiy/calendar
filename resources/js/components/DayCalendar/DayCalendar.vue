<template>
    <div class="col">
        <BaseHeaderCalendar class="border-bottom border-3 mb-3" />
        <div class="row">
            <div class="col-3">
                <BaseLeftBarCalendar />
            </div>
            <div class="col-8">
                <DayCalendarInterface />
            </div>
        </div>
    </div>
</template>

<script>
import BaseHeaderCalendar from "../ Base/BaseLeftBar/BaseHeaderCalendar";
import BaseLeftBarCalendar from "../ Base/BaseLeftBar/BaseLeftBarCalendar";
import DayCalendarInterface from "./DayCalendarInterface";
export default {
    name: "DayCalendar",
    components: {DayCalendarInterface, BaseLeftBarCalendar, BaseHeaderCalendar},

}
</script>

