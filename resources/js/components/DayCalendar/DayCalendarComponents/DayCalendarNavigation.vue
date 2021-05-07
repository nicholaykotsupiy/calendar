<template>
    <div class="nav d-flex align-items-center position-absolute">
        <div class="">
            <div @click="switchToCurrentDate" class="today day d-flex justify-content-center align-items-center">
                <span>Сегодня</span>
            </div>
        </div>
        <div class=" arrows d-flex">
            <div @click="prevDate" class="arrow-left"><img :src="left_arrow" alt="left-arrow"></div>
            <div @click="nextDate" class="arrow-right"><img :src="right_arrow" alt="right-arrow"></div>
        </div>
    </div>
</template>

<script>
import left_arrow from "../../../assets/img/DayCalendar/left-arrow.png";
import right_arrow from "../../../assets/img/DayCalendar/right-arrow.png";

export default {
    name: "DayCalendarNavigation",
    data: () => ({
        left_arrow,
        right_arrow,
    }),
    methods: {
        switchToCurrentDate() {
            this.$emit('current')
        },
        prevDate() {
            this.$emit('prev')
        },
        nextDate() {
            this.$emit('next')
        },
    }
}
</script>

<style scoped>
.today, .arrow-left, .arrow-right {
    cursor: pointer;
}
.nav {
    z-index: 10;
    top: 116px;
    left: 20%;
}
.today {
    max-width: 120px;
    margin-right: 30px;
}
.arrows div {
    padding: 8px;
    background: #fff;
    border: 2px solid #F5F5F5;
    border-radius: 0px 4px 4px 0px;
}
.day {
    height: 50px;
    padding: 5px 36px;
    background: #fff;
    border: 2px solid #F5F5F5;
    border-radius: 4px;
    font-weight: 600;
    font-size: 14px;
    line-height: 60px;
    color: #666666;
}
</style>
