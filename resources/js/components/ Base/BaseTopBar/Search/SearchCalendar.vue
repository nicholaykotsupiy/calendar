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
            searchText: '',
            dateStart: null,
            dateEnd: null,
        }
    },
    props: ['openSearch'],
    methods: {
        resultSearch() {
            // поиск по подстроке
            const dateStartFilterTime = this.dateStart ? new Date(this.dateStart).getTime() : null
            const dateEndFilterTime = this.dateEnd ? new Date(this.dateEnd).getTime() : null
            let searchItems = []
            let searchResults = []
            if (this.searcheByBirthday) {
                searchItems = searchItems.concat(this.birthdays)
            }
            if (this.searcheByTasks) {
                searchItems = searchItems.concat(this.tasks)
            }
            if (this.searcheByEvents) {
                searchItems = searchItems.concat(this.events)
            }
            if (this.searcheByReminders) {
                searchItems = searchItems.concat(this.reminders)
            }
            for (let i = 0; i < searchItems.length; i++) {
                let birthdayDateStartTime = new Date(searchItems[i].dateStart).getTime()
                if ((searchItems[i].hasOwnProperty('description') && searchItems[i].description.indexOf(this.searchText) !== -1) || 
                    searchItems[i].name.indexOf(this.searchText) !== -1) {
                    if (this.dateStart && this.dateEnd) {
                        if (birthdayDateStartTime >= dateStartFilterTime &&
                            birthdayDateStartTime <= dateEndFilterTime) {
                            searchResults.push(searchItems[i])
                        }
                    }else if (this.dateStart) {
                        if (birthdayDateStartTime >= dateStartFilterTime) {
                            searchResults.push(searchItems[i])
                        }
                    }else if (this.dateEnd) {
                        if (birthdayDateStartTime <= dateEndFilterTime) {
                            searchResults.push(searchItems[i])
                        }
                    }else {
                        searchResults.push(searchItems[i])
                    }
                }
            }
            this.$store.commit('setSearchResults', searchResults);
            this.$router.push('search-results').catch(()=>{})
            // todo uncomment!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            // this.$emit('close')
        },
        reset() {
            this.searchText = ''
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