<template>
    <div>
        <div class="flex">
            <div>
                <button v-on:click="decrease"><</button>
            </div>
            <div>
                <button v-on:click="increase">></button>
            </div>
            <div> {{ months[month] }} {{ year }}</div>
        </div>
        <table class="week">
            <tr>
                <th>день</th>
                <th v-for="day in days">
                    <span>{{ day.day_of_week.toUpperCase() }}</span>
                    <span :class="isCurrentDay(day) ? 'today' : ''">{{ day.day_of_month }}</span>

                </th>
            </tr>
            <tr v-for="time in times">
                <td>{{time}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
</template>
<script>




export default {
    name: "Week",
    components: {},

    data() {

        return {
            month: new Date().getMonth(),
            year: new Date().getFullYear(),
            dFirstMonth: 1,
            day: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
            months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            isVisibleModal: false,
            days: [],
            daysOfCurrentWeek: [],
            times: [
                '00:00', '1:00', '2:00', '3:00', '4:00', '5:00', '6:00',
                '7:00', '8:00', '9:00', '10:00', '11:00', '12:00',
                '13:00', '14:00', '15:00', '16:00', '17:00', '18:00',
                '19:00', '20:00', '21:00', '22:00', '23:00',
            ],
        }
    },
    created() {
        const startDateOfCurrentWeek = this.$moment().weekday(0);
        const endDateOfCurrentWeek = this.$moment().weekday(6);
        this.daysOfCurrentWeek = this.getDaysBetweenTwoDates(startDateOfCurrentWeek, endDateOfCurrentWeek);
        this.days = this.daysOfCurrentWeek;
    },
    methods: {
        getDaysBetweenTwoDates(startDate, endDate) {
            let now = startDate.clone(), days = [];

            while (now.isSameOrBefore(endDate)) {
                let day = {};
                day.day_of_week = now.format('dddd');
                day.day_of_month = now.format('D');
                day.full_date = now.format();
                days.push(day);
                now.add(1, 'days');
            }
            return days;
        },
        isCurrentDay(day) {
            const currentDate = this.$moment().format('M-D-Y');
            const thisDate = this.$moment(day.full_date).format('M-D-Y');
            if (currentDate === thisDate) {
                return true;
            }
            return false;
        },
        decrease: function () {
            const startDate = this.$moment(this.days[0].full_date).subtract('7', 'days');
            const endDate = this.$moment(this.days[this.days.length - 1].full_date).subtract('7', 'days');
            this.days = this.getDaysBetweenTwoDates(startDate, endDate);
        },

        increase() {
            const startDate = this.$moment(this.days[0].full_date).add('7', 'days');
            const endDate = this.$moment(this.days[this.days.length - 1].full_date).add('7', 'days');
            this.days = this.getDaysBetweenTwoDates(startDate, endDate);
        },
        // showModal() {
        //     this.isVisibleModal = true;
        // },
        //
        // close() {
        //     this.isVisibleModal = false;
        // },
        //
        // saveClickEvent() {
        //     //console.log('Save event')
        //     //после удачного сохранения события спрятать форму
        //     this.isCreateEventWindowVisible = false;
        // },
    }
}
</script>

<style scoped>

/*.main th {*/
/*    padding: 10px 10px;*/
/*    font-family: "Nunito", sans-serif;*/
/*    font-weight: 500;*/
/*    font-size: 12px;*/
/*    line-height: 30px;*/
/*    text-align: center;*/
/*    margin: 0 auto;*/
/*}*/

table {
    width: 300px;
    border-collapse: collapse;
    border: 2px solid white;
    color: #B2B2B2;
    left: 26.2%;
    top: 200px;
    background: white;
}

td, th {
    padding: 10px 10px;
    border: 1px solid #B2B2B2;
    text-align: left;
    white-space: nowrap;
    font-weight: 500;
    font-size: 12px;
    line-height: 30px;
    background: white;
    color: #808080;
}
.today{
    background: #1875F0;
    color: #ffffff;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    padding: 5px;
}
/*td {*/
/*    font-weight: 500;*/
/*    font-size: 12px;*/
/*    line-height: 30px;*/
/*    padding: 5px 0px;*/
/*}*/

/*.pink {*/
/*    border-left: 3px solid #C92A73;*/
/*    padding: 10px;*/
/*    color: #C92A73;*/
/*    background: rgba(201, 42, 115, 0.2);*/
/*}*/

/*.orange {*/
/*    border-left: 3px solid #FF9500;*/
/*    padding: 10px;*/
/*    color: #FF9500;*/
/*    background: rgba(255, 149, 0, 0.2);*/
/*}*/

/*.blue {*/
/*    border-left: 3px solid #19ADF8;*/
/*    padding: 10px;*/
/*    color: #19ADF8;*/
/*    background: rgba(25, 173, 248, 0.2);*/
/*}*/

/*.green {*/
/*    border-left: 3px solid #73DE4F;*/
/*    padding: 10px;*/
/*    color: #73DE4F;*/
/*    background: rgba(115, 222, 79, 0.2);*/
/*}*/

/*.peach {*/
/*    border-left: 3px solid #ffcc01;*/
/*    padding: 10px;*/
/*    color: #ffcc01;*/
/*    background: rgba(255, 204, 1, 0.2);*/
/*}*/

/*.brown {*/
/*    border-left: 3px solid #99572B;*/
/*    padding: 10px;*/
/*    color: #99572B;*/
/*    background: rgba(153, 87, 43, 0.2);*/
/*}*/

.flex {
    display: flex;
    align-content: space-between;
}


</style>
