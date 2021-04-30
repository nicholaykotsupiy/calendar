<template>
    <table class="w-100 border-top events">
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr
            ref="tr"
            v-for="line in timeLine" :key="new Date().time"
            :style="{height: '60px'}">
            <td
                v-if="line.slice(0, line.indexOf(':')) == event.start.slice(0, event.start.indexOf(':'))"
                v-for="event of events" :style="{background: event.color}"
                :key="event.id"
                :rowspan="event.end"
                class="event_item border col-auto position-relative">
                <div class="info d-flex align-items-top position-absolute top-0">
                    <span class="exect_time">{{ event.start }}</span>
                    <span class="title">{{ event.title }}</span>
                </div>
                <div class="buttons">
                    <img v-if="event.peoples !== []" :src="peoples" alt="peoples">
                    <img :src="del" alt="delete">
                    <img :src="edit" alt="edit">
                </div>
            </td>
        </tr>
    </table>
</template>

<script>
import del from '../../../assets/img/DayCalendar/delete.svg'
import  edit from '../../../assets/img/DayCalendar/edit.svg'
import  peoples from '../../../assets/img/DayCalendar/peoples.png'

// console.log(155)

export default {
    name: "DayCalendarEnents",
    props: ['events', 'timeLine'],
    data: () => ({
        del,
        edit,
        peoples,
    }),
    mounted() {
        for(let tr of this.$refs.tr){
            if(tr.querySelectorAll('td').length == 1 && tr.querySelector('td').getAttribute('rowspan') == 1) {
                tr.querySelector('td').setAttribute('colspan', 2)
            }
        }
    }
}
</script>

<style scoped>
    .event_item {
        width: auto;
        background: #D2EFFE;
        height: 60px;
        border-left: 2px solid #19ADF8;
    }
    .buttons {
        position: absolute;
        top: 0;
        right: 0;
    }
    .info {
        top: 0px;
        font-weight: 900;
        font-size: 12px;
        line-height: 60px;
        color: #2675B5;
    }
    .exect_time {
        padding: 0 20px 0 15px;
    }
</style>
