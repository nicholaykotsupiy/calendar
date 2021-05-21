<template>
    <form class="search-calendar">
        <div class="position-search">
            <div class="flex btn-control">
                <button>Сброс</button>
                <button>Поиск</button>
            </div>
        </div>
        
    </form>
</template>

<script>
export default {

    name: "SearchCalendar",

    setup() {
        
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