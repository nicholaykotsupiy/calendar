import Vue from 'vue'
import VueRouter from 'vue-router'
import DayCalendarInterface from '../components/DayCalendar/DayCalendarInterface'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'DayCalendarInterface',
        component: DayCalendarInterface
    },
    {
        path: '/month',
        name: 'Month',
        component: () => import('../components/Month/TheMonth')
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
})

export default router
