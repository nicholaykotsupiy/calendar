<template xmlns="http://www.w3.org/1999/html">
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
                    {{ day.day_of_week.toUpperCase() }} {{ day.day_of_month }}
                </th>
            </tr>
            <tr>
                <td>1:00</td>
                <td></td>
                <!--                отображение мод.окна-->
                <td>
                    <div class="pink" :id="`event`" variant="primary">Вселенная через...</div>
                    <b-popover
                        :show.sync="pop"
                        target="event"
                        placement="leftbottom"
                        triggers="click"
                    >
                        <template  #title>
                            <div class="icons">
                                <span class="material-icons">delete</span>
                                <span class="material-icons" @click="doEdit">edit</span>
                                <span class="material-icons"  @click="popClose">close</span>
                            </div>
                        </template>
                        <span class="title">Вселенная через 1 час</span><br>
                        <span class="time">Суббота, 7 января 4:00 - 4:10</span>
                    </b-popover>
                </td>
                <td>
                    <div class="pink">Вселенная через...</div>
                </td>
                <td>
                    <div class="pink">Вселенная через...</div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2:00</td>
                <td></td>
                <td></td>
                <td>
                    <div class="orange">Основы покупки...</div>
                </td>
                <td>
                    <div class="orange">Основы покупки...</div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>3:00</td>
                <td></td>
                <td></td>
                <td>
                    <div class="blue">Готовим на гриле</div>
                </td>
                <td></td>
                <td>
                    <div class="peach">Занимайся спортом...</div>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>4:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <div class="green">Вселенная через...</div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <div class="brown">Вселенная через...</div>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
</template>
<script>


export default {
    name: "Week",

    data() {
        return {
            month: new Date().getMonth(),
            year: new Date().getFullYear(),
            dFirstMonth: 1,
            day: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
            months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            pop: false,
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
        popClose() {
            this.pop = false
        },
    }
}
</script>

<style scoped>
.main th {
    padding: 10px 5px;
    font-family: "Nunito", sans-serif;
    font-weight: 500;
    font-size: 12px;
    line-height: 30px;
    text-align: center;
    margin: 0 auto;
}

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
    padding: 3px;
    border: 1px solid #B2B2B2;
    text-align: left;
    white-space: nowrap;
    font-weight: 500;
    font-size: 12px;
    line-height: 30px;
}

td {
    font-weight: 500;
    font-size: 12px;
    line-height: 30px;
    padding: 5px 0px;
}

.pink {
    border-left: 3px solid #C92A73;
    padding: 10px;
    color: #C92A73;
    background: rgba(201, 42, 115, 0.2);
}

.orange {
    border-left: 3px solid #FF9500;
    padding: 10px;
    color: #FF9500;
    background: rgba(255, 149, 0, 0.2);
}

.blue {
    border-left: 3px solid #19ADF8;
    padding: 10px;
    color: #19ADF8;
    background: rgba(25, 173, 248, 0.2);
}

.green {
    border-left: 3px solid #73DE4F;
    padding: 10px;
    color: #73DE4F;
    background: rgba(115, 222, 79, 0.2);
}

.peach {
    border-left: 3px solid #ffcc01;
    padding: 10px;
    color: #ffcc01;
    background: rgba(255, 204, 1, 0.2);
}

.brown {
    border-left: 3px solid #99572B;
    padding: 10px;
    color: #99572B;
    background: rgba(153, 87, 43, 0.2);
}

.flex {
    display: flex;
    align-content: space-between;
}
.icons{
    text-align:end;
}
</style>
