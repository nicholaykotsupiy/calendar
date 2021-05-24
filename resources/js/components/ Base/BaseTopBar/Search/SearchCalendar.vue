<template>
    <div class="search-calendar">
        <div class="position-search">
            <div>Область поиска*</div>
            <div class="name-filter">{{ inspectNameFilter }}</div>
            <div class="search-area">
                <label class="container-checkbox">Дни рождения
                    <input v-model="searcheByBirthday" type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Задачи
                    <input v-model="searcheByTasks" type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Мероприятия
                    <input v-model="searcheByEvents" type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Напоминания
                    <input v-model="searcheByReminders" type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <label>Что
                <input @keyup.enter="resultSearch" v-model="searchText" type="text" placeholder="Ключевые слова" id="searchCalendarText">
            </label>
            <label>Дата
                <input v-model="dateStart" type="date">
                <input v-model="dateEnd" type="date">
            </label>
            <div class="flex btn-control">
                <button @click.prevent="reset">Сброс</button>
                <button @click.prevent="resultSearch">Поиск</button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
    name: "SearchCalendar",
    data() {
        return {
            searcheByBirthday: true,
            searcheByTasks: true,
            searcheByEvents: true,
            searcheByReminders: true,
            searchText: null,
            dateStart: null,
            dateEnd: null,
        }
    },
    props: ['openSearch'],
    methods: {
        resultSearch() {
            // поиск по подстроке
            let searchResults = []
            if (this.searcheByBirthday) {
                for (let i = 0; i < this.birthdays.length; i++) {
                    if (this.birthdays[i].description.indexOf(this.searchText) !== -1 || 
                        this.birthdays[i].name.indexOf(this.searchText) !== -1) {
                        searchResults.push(this.birthdays[i])
                    }
                }
            }
            if (this.searcheByTasks) {
                for (let i = 0; i < this.tasks.length; i++) {
                    if (this.tasks[i].description.indexOf(this.searchText) !== -1 || 
                        this.tasks[i].name.indexOf(this.searchText) !== -1) {
                        searchResults.push(this.tasks[i])
                    }
                }
            }
            if (this.searcheByEvents) {
                for (let i = 0; i < this.events.length; i++) {
                    if (this.events[i].description.indexOf(this.searchText) !== -1 ||
                        this.events[i].name.indexOf(this.searchText) !== -1) {
                        searchResults.push(this.events[i])
                    }
                }
            }
            if (this.searcheByReminders) {
                for (let i = 0; i < this.reminders.length; i++) {
                    if (this.reminders[i].name.indexOf(this.searchText) !== -1) {
                        searchResults.push(this.reminders[i])
                    }
                }
            }
            
            // todo фильтр по типу
            // todo фильтр по дате
            this.$store.commit('setSearchResults', searchResults);
            this.$router.push('search-results').catch(()=>{})
        },
        reset() {
            this.searchText = null
            this.dateStart = null
            this.dateEnd = null
        }
    },
    computed: {
        ...mapState([
            'birthdays',
            'tasks',
            'events',
            'reminders',
        ]),
        inspectNameFilter() {
            let filter = []
            if (this.searcheByBirthday){
                filter.push('Дни рождения')
            }
            if (this.searcheByTasks) {
                filter.push('Задачи')
            }
            if (this.searcheByEvents) {
                filter.push('Мероприятия')
            }
            if (this.searcheByReminders) {
                filter.push('Напоминания')
            }
            return filter.join(', ')
        }
    },
}
</script>

<style scoped>
    .search-calendar{
        font-family: Roboto;
        font-size: 14px;
        font-weight: 900;
        color: #808080;
        position: relative;
    }
    .position-search {
        position: absolute;
        z-index: 5;
        background: #ffffff;
    }
    .flex {
        display: flex;
    }
    .btn-control {
        justify-content: space-evenly;
    }
    button {
        font-weight: 900;
        border: 2px solid #f5f5f5;
        background: #ffffff;
        color: #808080;
        padding: 15px 40px;
        border-radius: 0.25rem;
        cursor: pointer;
    }
    button:hover {
        color: #ffffff;
        border: 2px solid #1875f0;
        background: #1875f0;
    }
    .name-filter {
        border: 2px solid #d9d9d9;
        max-width: 200px;
        min-height: 25px;
    }
    .container-checkbox {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .container-checkbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }
    .container-checkbox:hover input ~ .checkmark {
        background-color: #ccc;
    }
    .container-checkbox input:checked ~ .checkmark {
        background-color: #1875f0;
    }
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    .container-checkbox input:checked ~ .checkmark:after {
        display: block;
    }
    .container-checkbox .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

</style>