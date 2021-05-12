import Vue from 'vue'
import VueRouter from 'vue-router'
import DayCalendarInterface from '../components/DayCalendar/DayCalendarInterface'
import TheAuth from "../components/auth/TheAuth";
import TheLogin from "../components/auth/TheLogin";
import TheLoginTwoFactor from "../components/auth/TheLoginTwoFactor";
import TheLoginCode from "../components/auth/TheLoginCode";
import TheRepairPassword from "../components/auth/TheRepairPassword";
import TheRepairPasswordCode from "../components/auth/TheRepairPasswordCode";
import TheRepairPasswordNew from "../components/auth/TheRepairPasswordNew";
import TheRepairPasswordCodeWord from "../components/auth/TheRepairPasswordCodeWord";
import main from "../layouts/main";
import middlewarePipeline from "./middlewarePipeline";
import isLogin from './isLogin';

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: main,
        name: 'base',
        children: [
            {
                path: '/',
                name: 'DayCalendarInterface',
                component: DayCalendarInterface,
                props: true,
                meta: {
                    middleware: [
                        isLogin
                    ]
                },
            },
            {
                path: 'week',
                name: 'Week',
                component: () => import('../components/Week/WeekComponent'),
                props: true,
                meta: {
                    middleware: [
                        isLogin
                    ]
                },
            },
            {
                path: 'month',
                name: 'Month',
                component: () => import('../components/Month/TheMonth'),
                props: true,
                meta: {
                    middleware: [
                        isLogin
                    ]
                },
            },
            {
                path: 'year',
                name: 'Year',
                component: () => import('../components/Year/TheYear'),
                props: true,
                meta: {
                    middleware: [
                        isLogin
                    ]
                },
            },
            {
                path: 'confirm-event/:uuid',
                component: () => import('../components/Notification/ConfirmEvent'),
                props: true,
                meta: {
                    middleware: [
                        isLogin
                    ]
                },
            },
        ]
    },
    {
        path: '/login',
        name: 'login.base',
        component: TheAuth,
        children: [
            {
                path: '/',
                name: 'login.index',
                component: TheLogin
            },
            {
                path: 'two-step',
                name: 'login.two-step',
                component: TheLoginTwoFactor
            },
            {
                path: 'code',
                name: 'login.code',
                component: TheLoginCode
            },
            {
                path: 'repair-password',
                name: 'login.repair',
                component: TheRepairPassword
            },
            {
                path: 'repair-password/code',
                name: 'login.repair.code',
                component: TheRepairPasswordCode
            },
            {
                path: 'repair-password/new-password',
                name: 'login.repair.new',
                component: TheRepairPasswordNew
            },
            {
                path: 'repair-password/code-word',
                name: 'login.repair.word',
                component: TheRepairPasswordCodeWord
            }
        ]
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
})
router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware
    const context = {
        to,
        from,
        next
    }
    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    })
})
export default router
