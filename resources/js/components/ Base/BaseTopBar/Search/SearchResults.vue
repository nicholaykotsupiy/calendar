<template>
    <div class="search-results container">
        <div class="flex table-search">
            <div class="date">
                <div class="date-search flex">дата</div>
            </div>
            <div class="time">
                <div class="time-search">время</div>
            </div>
            <div v-if="this.searchResults && this.searchResults.length > 0" class="search-body">
                <div v-for="result in searchResults" :key="result.id + result.type" class="search-result flex">
                    <div>{{ result.dateStart }}</div>
                    <div>{{ result.timeStart }} {{ result.name }}. {{ result.description }}</div>
                </div>
            </div>
            <div v-else>Ничего не найдено</div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
    name: 'SearchResults',
    computed: {
        ...mapState([
            'searchResults',
        ]),
    },
}
</script>

<style scoped>
    .search-results {
        font-family: Roboto;
        font-size: 14px;
        font-weight: 500;
        color: #808080;
        max-width: 850px;
        background: #ffffff;
    }
    .container {
        min-height: 780px;
    }
    .flex {
        display: flex;
        align-content: space-between;
        flex-wrap: wrap;
    }
    .date {
        border-right: 2px solid #f5f5f5;
    }
    .date-search {
        border-bottom: 2px solid #f5f5f5;
        min-width: 120px;
        justify-content: flex-end;
    }
    .time-search {
        border-bottom: 2px solid #f5f5f5;
        min-width: 660px;
    }
</style>