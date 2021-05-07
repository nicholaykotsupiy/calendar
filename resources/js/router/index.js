import Vue from 'vue'
import VueRouter from 'vue-router'
import DayCalendarInterface from '../components/DayCalendar/DayCalendarInterface'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'DayCalendarInterface',
        component: DayCalendarInterface,
        props: true
    },
    {
        path: '/week',
        name: 'Week',
        component: () => import('../components/Week/WeekComponent'),
        props: true
    },
    {
        path: '/month',
        name: 'Month',
        component: () => import('../components/Month/TheMonth'),
        props: true
    },
    {
        path: '/year',
        name: 'Year',
        component: () => import('../components/Year/TheYear'),
        props: true
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
})

export default router
