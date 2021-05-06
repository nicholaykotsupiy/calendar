export default {

    state() {
        return {
            isCreateEventWindowVisible: true,
            isCreateReminderWindowVisible: false,
            isCreateTaskWindowVisible: false,
            isCreateBirthdayWindowVisible: false,

            titleModalMessage: '',
            bodyModalMessage: ''
        }
    },

    getters: {

        isCreateEventWindowVisible(state) {
            return state.isCreateEventWindowVisible
        },
        isCreateReminderWindowVisible(state) {
            return state.isCreateReminderWindowVisible
        },
        isCreateTaskWindowVisible(state) {
            return state.isCreateTaskWindowVisible
        },
        isCreateBirthdayWindowVisible(state) {
            return state.isCreateBirthdayWindowVisible
        },

        titleModalMessage(state) {
            return state.titleModalMessage
        },

        bodyModalMessage(state) {
            return state.bodyModalMessage
        },

    },

    mutations: {

        setIsCreateEventWindowVisible(state, value) {
            state.isCreateEventWindowVisible = value
        },
        setIsCreateReminderWindowVisible(state, value) {
            state.isCreateReminderWindowVisible = value
        },
        setIsCreateTaskWindowVisible(state, value) {
            state.isCreateTaskWindowVisible = value
        },
        setIsCreateBirthdayWindowVisible(state, value) {
            state.isCreateBirthdayWindowVisible = value
        },

        showCreateEventWindow(state) {
            state.isCreateEventWindowVisible = true
            state.isCreateReminderWindowVisible = false
            state.isCreateTaskWindowVisible = false
            state.isCreateBirthdayWindowVisible = false
        },

        setTitleModalMessage(state, value) {
            state.titleModalMessage = value
        },
        setBodyModalMessage(state, value) {
            state.bodyModalMessage = value
        },

    },

    actions: {



    }
}
