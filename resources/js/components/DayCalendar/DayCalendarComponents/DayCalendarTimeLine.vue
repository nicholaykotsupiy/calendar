<template>
    <ul class="list">
        <li class="item d-flex" v-for="line in timeLine">
            <div class="time d-flex justify-content-end align-items-start border-right border-2">
                <span v-if="line !== '00:00'">{{ line }}</span>
            </div>
            <ul class="event col-11 d-flex w-auto border-top border-bottom">
                <li v-if="line.slice(0, line.indexOf(':')) == event.start.slice(0, event.start.indexOf(':'))" v-for="event in events" :key="event.id" :style="{background: event.color}" class="event_item col border-right position-relative">
                    <div class="info d-flex align-items-center">
                        <span class="exect_time">{{ event.start }}</span>
                        <span class="title">{{ event.title }}</span>
                    </div>
                    <div class="buttons">
                        <img v-if="event.peoples.length !== 0" :src="peoples" alt="peoples">
                        <img :src="del" alt="delete">
                        <img :src="edit" alt="edit">
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
import del from '../../../assets/img/DayCalendar/delete.svg'
import  edit from '../../../assets/img/DayCalendar/edit.svg'
import  peoples from '../../../assets/img/DayCalendar/peoples.png'

export default {
    name: "DayCalendarTimeLine",
    props: ['timeLine', 'events'],
    data: () => ({
        del,
        edit,
        peoples,
    })
}
</script>

<style scoped>
ul, li {
    padding: 0;
    list-style: none;
}
.time {
    height: 60px;
    width: 60px;
    padding-right: 10px;
}
.time span {
    font-weight: 500;
    font-size: 12px;
    line-height: 20px;
    color: #B3B3B3;
    margin-top: -12px;
}
.item {;
    width: 100%;
}
.event {
}
.event_item {
    width: auto;
    background: #D2EFFE;
    height: 100%;
    border-left: 2px solid #19ADF8;
}
.buttons {
    position: absolute;
    top: 0;
    right: 0;
}
.info {
    font-weight: 900;
    font-size: 12px;
    line-height: 60px;
    color: #2675B5;
}
.exect_time {
    padding: 0 20px 0 15px;
}
</style>
