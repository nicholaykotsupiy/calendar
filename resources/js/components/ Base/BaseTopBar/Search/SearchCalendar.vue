<template>
    <form class="search-calendar">
        <div class="position-search">
            <div class="flex btn-control">
                <button>Сброс</button>
                <button @click="resultSearch">Поиск</button>
            </div>
        </div>
    </form>
</template>

<script>
import { mapState } from 'vuex';
export default {
    name: "SearchCalendar",
    data() {
        return {
            
        }
    },
    props: ['searchText'],
    methods: {
        resultSearch() {
            // поиск по подстроке
            let searchResults = []
            for (let i = 0; i < this.events.length; i++) {
                if (this.events[i].description.indexOf(this.searchText) !== -1) {
                    searchResults.push(this.events[i])
                }
            }
            // todo фильтр по типу
            // todo фильтр по дате
            this.$store.commit('setSearchResults', searchResults);
            this.$router.push('search-results')
        }
    },
    computed: {
        ...mapState([
            'events'
        ])
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
</style>