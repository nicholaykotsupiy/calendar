<template>
    <ul>
        <li v-for="guest in eventItem.guestsArr" class="list_item d-flex justify-content-between align-items-center py-2 border-top">
            <span class="email">{{ guest.mail }}</span>
            <span class="status">{{ guest.status ? 'Подтвержден': 'Не подтвержден' }}</span>
        </li>
    </ul>
</template>

<script>
export default {
    name: "GuestsListModal",
    props: ['eventItem'],
    mounted() {
        console.log(this.eventItem)
        document.querySelector('.modal-body').style.paddingTop = '0'
        document.querySelector('.modal-body').style.paddingBottom = '0'
    }
}
</script>

<style scoped>
    ul,li {
        margin: 0;
        padding: 0;
        list-style: none;
    }
</style>
