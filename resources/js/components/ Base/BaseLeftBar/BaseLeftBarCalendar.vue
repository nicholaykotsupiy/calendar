<template>
    <div class="row d-flex flex-column align-items-center align-items-xl-start flex-xl-row">
        <BaseLeftBarButton />
        <div class="mx-auto mb-2">
            <BaseMiniCalendar />
        </div>
        <BaseLeftBarOption />
    </div>
</template>

<script>
import arrow from "../../../assets/img/DayCalendar/arrow_callendars.png"
import BaseMiniCalendar from "./BaseMiniCalendar";
import BaseLeftBarOption from "./BaseLeftBarOption";
import BaseLeftBarButton from "./BaseLeftBarButton";
export default {
    name: "BaseLeftBarCalendar",
    components: {BaseLeftBarButton, BaseLeftBarOption, BaseMiniCalendar},
    data: () => ({
        arrow,
        openCalendars: true,
        calendars: [
            {
                id: 1,
                name: 'Дни рождения',
                option: {
                    active: true,
                    colors: [],
                }
            },
            {
                id: 2,
                name: 'Задачи',
                option: {
                    active: false,
                    colors: [],
                }
            },
            {
                id: 3,
                name: 'Мероприятие',
                option: {
                    active: false,
                    colors: [],
                }
            },
            {
                id: 4,
                name: 'Напоминания',
                option: {
                    active: false,
                    colors: [],
                }
            },
            {
                id: 5,
                name: 'Праздники Украины',
                option: {
                    active: false,
                    colors: [],
                }
            },
        ]
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
        openBar(calendar, index) {
            if(calendar.option.active) {
                this.$refs.item[index].style.transform = 'rotate(0deg)'
            } else {
                this.$refs.item[index].style.transform = 'rotate(90deg)'
            }
            calendar.option.active = !calendar.option.active
        },
        addColors(option, color) {
            if(option.colors.indexOf(color) === -1){
                option.colors.push(color)
            } else {
                option.colors.splice(option.colors.indexOf(color), 1)
            }
        }
    }
}
</script>
