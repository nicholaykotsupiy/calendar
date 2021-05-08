<template>
 <div class="wrapper row">
    <div class="w-100">
        <DayCalendarHead />
    </div>
     <div class="calendar_body d-flex col-12 overflow-auto mb-4">
        <DayCalendarTimeLine :timeLine="timeLine"/>
         <DayCalendarEnents
             :currentDate="currentDate"
             :timeLine="timeLine"
             :events="allEventsForDay"
         />
     </div>
 </div>
</template>

<script>
import DayCalendarHead from "./DayCalendarComponents/DayCalendarHead";
import DayCalendarTimeLine from "./DayCalendarComponents/DayCalendarTimeLine";
import DayCalendarEnents from "./DayCalendarComponents/DayCalendarEnents";
import { mapGetters } from 'vuex'
import axios from "axios";

export default {
    name: "DayCalendarInterface",
    components: {
        DayCalendarEnents,
        DayCalendarHead,
        DayCalendarTimeLine,
    },
    data: () => ({
        timeLine: [
            '00:00','01:00','02:00','03:00','04:00','05:00','06:00',
            '07:00','08:00','09:00','10:00','11:00','12:00',
            '13:00','14:00','15:00','16:00','17:00','18:00',
            '19:00','20:00','21:00','22:00','23:00',
        ],
    }),
    computed: {
        ...mapGetters([
            'currentDate',
            'allEventsForDay'
        ])
    },
}
</script>

<style scoped>
.calendar_body {
    height: 660px;
}
.calendar_body::-webkit-scrollbar { width: 0; }
</style>
