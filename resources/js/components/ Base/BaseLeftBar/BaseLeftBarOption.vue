<template>
    <div class="calendars mx-auto my-4">
        <div @click="openList" class="title d-flex justify-content-between align-items-center">
            <span>Мои календари</span>
            <img ref="header" :src="arrow" alt="arrow">
        </div>
        <OptionList :openCalendars="openCalendars" />
    </div>
</template>

<script>
import arrow from "../../../assets/img/DayCalendar/arrow_callendars.png";
import OptionList from "./BaseOptionList/OptionList";

export default {
    name: "BaseLeftBarOption",
    components: {OptionList},
    data: () => ({
        arrow,
        openCalendars: false,
    }),
    methods: {
        openList() {
            if(this.openCalendars) {
                this.$refs.header.style.transform = 'rotate(0deg)'
            } else {
                this.$refs.header.style.transform = 'rotate(90deg)'
            }
            this.openCalendars = !this.openCalendars
        },
    }
}
</script>

<style scoped>
    *,body {
        font-family: Roboto;
    }
    ul, li {
        padding: 0;
        list-style: none;
    }
    .calendars {
        cursor: pointer;
        width: 90%;
        max-width: 270px;
    }
    .calendars .title {
        padding: 6px 14px;
        width: 100%;
        background: #FFFFFF;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
        border-radius: 6px;
        color: #808080;
    }
</style>
