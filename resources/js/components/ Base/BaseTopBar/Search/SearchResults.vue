<template>
    <div class="search-results container">
        <div class="table-search">
            <div class="flex">
                <div class="date">
                    <div class="date-search flex">дата</div>
                </div>
                <div class="time">
                    <div class="time-search">время</div>
                </div>
            </div>
            <div v-if="this.searchResults && this.searchResults.length > 0" class="search-body">
                <div v-for="result in searchResults" :key="result.id + result.type" class="search-result flex">
                    <div class="resultDate">{{ result.dateStart }}</div>
                    <div class="resultTimeDescription">{{ result.timeStart }} {{ result.name }}. {{ result.description }}</div>
                </div>
            </div>
            <div v-else class="flex searchErrors">
                <div>Ничего не найдено</div>
            </div>
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
        width: 100%;
        font-family: Roboto;
        font-size: 14px;
        font-weight: 500;
        color: #808080;
        max-width: 850px;
        background: #ffffff;
        padding: 15px 0px;
    }
    .container {
        min-height: 780px;
    }
    .flex {
        display: flex;
    }
    .date {
        border-right: 2px solid #f5f5f5;
    }
    .date-search {
        border-bottom: 2px solid #f5f5f5;
        min-width: 120px;
        justify-content: flex-end;
        padding: 5px 10px;
    }
    .time-search {
        border-bottom: 2px solid #f5f5f5;
        min-width: 660px;
        padding: 5px 10px;
    }
    .resultDate {
        padding: 5px 10px;
        min-width: 120px;
    }
    .resultTimeDescription {
        padding: 5px 10px;
        width: 100%;
        max-width: 660px;
    }
    .resultTimeDescription:nth-child(3n) {
        background: #e0f7d7;
        color: #008947;
        border-left: 2px solid #63da38;
    }
    .resultTimeDescription:nth-child(3n+1) {
        background: #d2effe;
        color: #2675b5;
        border-left: 2px solid #19adf8;
    }
    .resultTimeDescription:nth-child(3n+2) {
        background: #f5e3f9;
        color: #8d3b84;
        border-left: 2px solid #cc73e1;
    }
    .searchErrors {
        justify-content: center;
        align-items: center;
        height: 300px;
        font-size: 30px;
    }
</style>