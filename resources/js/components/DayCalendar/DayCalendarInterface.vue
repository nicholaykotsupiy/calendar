<template>
 <div class="wrapper row">
    <div class="w-100">
        <DayCalendarHead />
    </div>
     <div class="calendar_body col-12 overflow-auto mb-4">
        <DayCalendarTimeLine :events="events" :timeLine="timeLine"/>
     </div>
 </div>
</template>

<script>
import DayCalendarHead from "./DayCalendarComponents/DayCalendarHead";
import DayCalendarTimeLine from "./DayCalendarComponents/DayCalendarTimeLine";
export default {
    name: "DayCalendarInterface",
    components: {
        DayCalendarHead,
        DayCalendarTimeLine,
    },
    data: () => ({
        timeLine: [
            '00:00','1:00','2:00','3:00','4:00','5:00','6:00',
            '7:00','8:00','9:00','10:00','11:00','12:00',
            '13:00','14:00','15:00','16:00','17:00','18:00',
            '19:00','20:00','21:00','22:00','23:00',
        ],
        events: [
            {
                id: 1,
                color: '#D2EFFE',
                title: 'День рождения у К. Карины',
                start: '00:30',
                end: '1:00',
                peoples: [1]
            },
            {
                id: 2,
                color: '#E0F7D7',
                title: 'Написать ТЗ',
                start: '2:30',
                end: '3:00',
                peoples: [1,2]
            },
            {
                id: 3,
                color: '#FEEACC',
                title: 'Поиск материалов',
                start: '00:30',
                end: '4:00',
                peoples: []
            }
        ]
    })
}
</script>

<style scoped>
.calendar_body {
    height: 660px;
}
.calendar_body::-webkit-scrollbar { width: 0; }
</style>
