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
            'saveAccessFromServer',
        ]),
    },
    computed: {
      ...mapGetters([
         'access_token'
      ]),
    },
    created() {
        console.log(!this.access_token)
        if(!this.access_token){
            let user = this.$route.params.user
            let token = this.$route.params.token
            axios.post('/api/login', {token, user})
                .then(response => {
                    console.log(response)
                    this.saveAccessFromServer(token);
                    this.$router.push('/');
                })
        }
    }
}
</script>

<style scoped>

</style>
