<template>
    <div class="header py-2 row d-flex justify-content-between align-items-center">
        <div class="col-8 d-flex justify-content-between align-items-center">
            <div class="col menu d-flex align-items-center">
                <img :src="menu" alt="menu">
                <span>Календарь</span>
            </div>
            <div class="col-2">
                <div class="today day d-flex justify-content-center align-items-center">
                    <span>Сегодня</span>
                </div>
            </div>
            <div class="col-2 arrows d-flex">
                <div class="arrow-left"><img :src="left_arrow" alt="left-arrow"></div>
                <div class="arrow-right"><img :src="right_arrow" alt="right-arrow"></div>
            </div>
            <div class="col-2 date-info">Апрель 2020</div>
            <form class="col-5 search px-2">
                <img :src="search" alt="search">
                <input type="text" class="border-0" placeholder="Поиск">
            </form>
        </div>
        <div class="col-2 pr-4">
            <div class="drop_day day d-flex justify-content-center align-items-center">
                <span>День</span>
                <img :src="arrow_down" alt="arrow_down">
            </div>
        </div>
    </div>
</template>

<script>
import menu from "../../../assets/img/DayCalendar/menu.png"
import left_arrow from "../../../assets/img/DayCalendar/left-arrow.png"
import right_arrow from "../../../assets/img/DayCalendar/right-arrow.png"
import arrow_down from "../../../assets/img/DayCalendar/arrow_down1.png"
import search from "../../../assets/img/DayCalendar/search.png"

export default {
    name: "BaseHeaderCalendar",
    data: () => ({
        menu,
        left_arrow,
        right_arrow,
        arrow_down,
        search,
    })
}
</script>

<style scoped>
    *, body {
        font-family: Roboto;
    }
    .menu {
        font-weight: 600;
        font-size: 14px;
        line-height: 60px;
        color: #808080;
    }
    .arrow-left, .arrow-right, .menu img {
        cursor: pointer;
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
    .arrows div {
        padding: 8px;
        background: #fff;
        border: 2px solid #F5F5F5;
        border-radius: 0px 4px 4px 0px;
    }
    .date-info {
        font-weight: 600;
        font-size: 14px;
        line-height: 60px;
        color: #666666;
    }
    .drop_day {
        padding: 5px 20px;
        cursor: pointer;
        margin-right: 10px;
        padding-right: 0;
        color: #B2B2B2;
    }
    .search {
        background: #fff;
    }
    .search input {
        outline: none;
        width: 85%;
    }
    .search input, .search input::placeholder {
        font-weight: bold;
        font-size: 14px;
        line-height: 50px;
        color: #999999;
    }
    .today {
        max-width: 120px;
    }
</style>
