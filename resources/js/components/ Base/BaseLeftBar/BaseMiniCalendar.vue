<template>
    <b-calendar v-model="value" locale="ru"></b-calendar>
</template>

<script>

export default {
    name: "BaseMiniCalendar",
    data: () => ({
        value: '',
    }),
    mounted() {
        document.querySelector('.b-calendar-header').remove();
        document.querySelector('.b-calendar-nav').remove();
        document.querySelector('.b-calendar-grid-help').remove();
        document.querySelector('.b-calendar-grid').style.border = 'none';
        document.querySelector('.b-calendar-grid').classList.add('py-2')
        let header = document.querySelector('.b-calendar-grid-caption');
        let headerName = ''

        header.style.color = '#666666'
        header.style.padding = '15px 0'
        header.style.fontSize = '15px'
        header.style.fontFamily = 'Roboto'
        header.style.borderBottom = '3px solid #F5F5F5'

        headerName += header.innerHTML[0].toUpperCase()
        headerName += header.innerHTML.slice(1,header.innerHTML.indexOf('г.'))

        header.innerHTML = headerName

        let weekdays = document.querySelector('.b-calendar-grid-weekdays');

        weekdays.classList.remove('border-bottom')
        weekdays.classList.add('py-3')
        weekdays.style.fontWeight = '900'
        weekdays.style.letterSpacing = '1px'
        weekdays.style.fontSize = '14px'
        weekdays.style.color = '#808080'
    }
}
</script>

<style scoped>

</style>
