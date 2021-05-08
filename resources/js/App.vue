<template>
    <div id="app">
        <DayCalendarWrapper />
    </div>
</template>

<script>
import DayCalendarWrapper from "./components/DayCalendar/DayCalendarWrapper";
import { mapGetters, mapActions, mapMutations } from 'vuex'
import axios from "axios";

export default {

    components: {
        DayCalendarWrapper,
    },

    computed: {
        ...mapGetters([
            'currentDate',
            'allEventsForDay'
        ])
    },

    methods: {

        ...mapActions([
            'getDataFromServer'
        ]),

        load() {
            axios.get('/api/events').then(response => {
                this.getDataFromServer(response.data)
            })
        }
    },

    mounted() {
        this.load()
    }
}
</script>

<style scoped>

</style>
