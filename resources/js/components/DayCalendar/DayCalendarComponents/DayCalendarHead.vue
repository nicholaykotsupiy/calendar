<template>
    <div class="header d-flex">
        <div class="time col-2 border-bottom  border-right border-2 pb-1">Время</div>
        <div class="event ml-2 pb-1">Событие</div>
    </div>
</template>

<script>
export default {
    name: "DayCalendarHead"
}
</script>

<style scoped>
.header {

}
.time, .event {
    font-weight: 500;
    font-size: 12px;
    line-height: 30px;
}
.time {
    padding-right: 8px;
    color: #B3B3B3;
    flex-basis: 75px;
}
.event {
    background: #FAFAFA;
    color: #808080;
}
</style>
