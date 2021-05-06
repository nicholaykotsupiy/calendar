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
                v-for="(event, index) of events"
                v-if="
                    (line.slice(0, line.indexOf(':')) == event.timeStart.slice(0, event.timeStart.indexOf(':'))
                    &&
                    event.longsDate.includes(formatedDate)
                    &&
                    (event.longsDate.length < 1 || event.longsDate.indexOf(formatedDate) === 0))
                    ||
                    (line.slice(0, line.indexOf(':')) === '00' && event.longsDate.includes(formatedDate) && event.longsDate.indexOf(formatedDate) > 0)"
                :style="{background: '#D2EFFE'}"
                :key="index"
                :rowspan="event.longsDate.includes(virification)
                            ? 24 - event.timeStart.slice(0, event.timeStart.indexOf(':')) : event.longsDate.length > 1 ? event.end+1: event.end"
                class="event_item border col-auto position-relative">
                <div class="info d-flex align-items-top position-absolute top-0">
                    <span class="exect_time">{{ event.timeStart }}</span>
                    <span class="title">{{ event.name }}</span>
                </div>
                <div class="buttons">
                    <img v-if="event.guests" :src="peoples" alt="peoples">
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
import dateformat from "dateformat";


export default {
    name: "DayCalendarEnents",
    props: ['events', 'timeLine', 'currentDate'],
    data: () => ({
        del,
        edit,
        peoples,
        formatedDate: ''
    }),
    mounted() {
        this.formatedDate = dateformat(this.currentDate, 'yyyy-mm-dd')

        console.log(this.virification)
        for(let tr of this.$refs.tr){
            if(tr.querySelectorAll('td').length == 1 && tr.querySelector('td').getAttribute('rowspan') == 1) {
                tr.querySelector('td').setAttribute('colspan', 2)
            }
        }
    },
    computed: {
        virification() {
            let date = new Date(this.currentDate)

            date.setDate(date.getDate() + 1)
            return dateformat(date, 'yyyy-mm-dd')
        }
    },
    watch: {
        currentDate() {
            this.formatedDate = dateformat(this.currentDate, 'yyyy-mm-dd')
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
