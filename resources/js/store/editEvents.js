export default {

    state() {
        return {
            isVisibleEditEventWindow: false,
            isVisibleEditReminderWindow: false,
            isVisibleEditTaskWindow: false,
            isVisibleEditBirthdayWindow: false,

            editModalTitle: 'Вселенная через 1 час (пример)',
            editModalTime: 'Суббота, 7 января 4:00 - 4:10 (пример)'
        }
    },

    getters: {

        isVisibleEditEventWindow(state) {
            return state.isVisibleEditEventWindow
        },
        isVisibleEditReminderWindow(state) {
            return state.isVisibleEditReminderWindow
        },
        isVisibleEditTaskWindow(state) {
            return state.isVisibleEditTaskWindow
        },
        isVisibleEditBirthdayWindow(state) {
            return state.isVisibleEditBirthdayWindow
        },

        editModalTitle(state) {
            return state.editModalTitle
        },
        editModalTime(state) {
            return state.editModalTime
        },

    },

    mutations: {

        setIsVisibleEditEventWindow(state, value) {
            state.isVisibleEditEventWindow = value
        },
        setIsVisibleEditReminderWindow(state, value) {
            state.isVisibleEditReminderWindow = value
        },
        setIsVisibleEditTaskWindow(state, value) {
            state.isVisibleEditTaskWindow = value
        },
        setIsVisibleEditBirthdayWindow(state, value) {
            state.isVisibleEditBirthdayWindow = value
        },

    },

    actions: {



    }
}
