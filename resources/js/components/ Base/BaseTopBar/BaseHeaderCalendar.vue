<template>
    <div class="header py-2 row d-flex justify-content-between align-items-center">
        <div class="col-8 d-flex justify-content-between align-items-center">
            <div @click="clickhandler" class="col menu d-flex align-items-center">
                <img :src="menu" alt="menu">
                <span>Календарь</span>
            </div>
            <div class="col-2">
<!--                <div class="today day d-flex justify-content-center align-items-center">-->
<!--                    <span>Сегодня</span>-->
<!--                </div>-->
            </div>
            <div class="col-2 arrows d-flex">
<!--                <div class="arrow-left"><img :src="left_arrow" alt="left-arrow"></div>-->
<!--                <div class="arrow-right"><img :src="right_arrow" alt="right-arrow"></div>-->
            </div>
            <!--            если отображается календарь в масштабе год -->
            <template v-if="isYear">
                <div class="col-2 date-info">{{ titleNavigationCalendarYear }}</div>
            </template>
<!--            если отображается календарь в масштабе месяц -->
            <template v-else-if="isMonth">
                <div class="col-2 date-info">{{ titleNavigationCalendarMonth }}</div>
            </template>
<!--            если отображается календарь в масштабе день-->
            <template v-else>
                <div class="col-2 date-info">{{ dateInterface }}</div>
            </template>
            <form @click="openSearch" class="col-5 search px-2">
                <img :src="search" alt="search">
                <input type="text" class="border-0" placeholder="Поиск">
                <search-calendar v-if="activeSearch" @click="openSearch"></search-calendar>
            </form>
        </div>
        <nav class="col-2 pr-4 d-flex flex-column position-relative">
            <div  @click="openMenu" class="drop_day day d-flex justify-content-center align-items-center">
                <span>Календарь</span>
                <img :src="arrow_down" alt="arrow_down">
            </div>
            <ul v-if="activeMenu" @click="openMenu" class="main-menu position-absolute text-center">
                <router-link to="/" class="d-block menu_item border-top py-2" exact>День</router-link>
                <router-link to="/week" class="d-block menu_item border-top py-2" exact>Неделя</router-link>
                <router-link to="/month" class="d-block menu_item border-top py-2" exact>Месяц</router-link>
                <router-link to="/year" class="d-block menu_item border-top py-2" exact>Год</router-link>
            </ul>
        </nav>
    </div>
</template>

<script>
import menu from "../../../assets/img/DayCalendar/menu.png"
import left_arrow from "../../../assets/img/DayCalendar/left-arrow.png"
import right_arrow from "../../../assets/img/DayCalendar/right-arrow.png"
import arrow_down from "../../../assets/img/DayCalendar/arrow_down1.png"
import search from "../../../assets/img/DayCalendar/search.png"
import { mapGetters } from 'vuex'

export default {

    name: "BaseHeaderCalendar",

    data: () => ({
        activeMenu: false,
        menu,
        left_arrow,
        right_arrow,
        arrow_down,
        search,
        activeSearch: false,
    }),

    computed: {

        isMonth() {
            return this.isMonth
        },

        titleNavigationCalendarMonth() {
            return this.titleNavigationCalendarMonth
        },

        isYear() {
            return this.isYear
        },

        titleNavigationCalendarYear() {
            return this.titleNavigationCalendarYear
        },

        ...mapGetters([
            'isMonth',
            'titleNavigationCalendarMonth',
            'dateInterface',
            'isYear',
            'titleNavigationCalendarYear'
        ])
    },

    methods: {
        clickhandler() {
            this.$emit('open')
        },
        openMenu () {
            this.activeMenu = !this.activeMenu
        },
        openSearch() {
            this.activeSearch = !this.activeSearch
        }
    },
}
</script>

<style scoped>
    *, body {
        font-family: Roboto;
    }
    ul, li {
        list-style: none;
        padding: 0;
    }
    .menu {
        font-weight: 600;
        font-size: 14px;
        line-height: 60px;
        color: #808080;
    }
    .menu img, .menu span {
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
    .main-menu {
        top: 48px;
        width: 77%;
        z-index: 2;
        background: #fff;
    }
    .menu_item {
        text-decoration: none;
        color: #B2B2B2;
        cursor: pointer;
    }
    .router-link-exact-active {
        font-weight: 600;
    }
</style>
