<template>
    <ul class="list">
        <li class="item d-flex" v-for="line in timeLine">
            <div class="time d-flex justify-content-end align-items-start border-right border-2">
                <span v-if="line !== '00:00'">{{ line }}</span>
            </div>
        </li>
    </ul>
</template>

<script>
import DayCalendarEnents from "./DayCalendarEnents";

export default {
    name: "DayCalendarTimeLine",
    components: {DayCalendarEnents},
    props: ['timeLine', 'events'],
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
</style>
