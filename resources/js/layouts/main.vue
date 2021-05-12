<template>
    <DayCalendarWrapper />
</template>

<script>
import DayCalendarWrapper from "../components/DayCalendar/DayCalendarWrapper";
import axios from "axios";
import {mapActions, mapGetters} from "vuex";
export default {
    name: "main",
    components: {DayCalendarWrapper},
    methods: {
        ...mapActions([
            'saveUserFromServer',
        ]),
    },
    computed: {
      ...mapGetters([
         'user'
      ]),
    },
    created() {
        console.log(this.user)
        if(!this.user){
            let user = this.$route.params.user
            console.log(this.$route.params.user)
            axios.post('/api/login', user)
                .then(response => {
                    // console.log(response)
                    this.saveUserFromServer(response.data);
                    this.$router.push('/');
                })
        }
    }
}
</script>

<style scoped>

</style>
