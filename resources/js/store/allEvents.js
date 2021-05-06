export default {

    state() {
        return {
            isCreateEventWindowVisible: true,
            isCreateReminderWindowVisible: false,
            isCreateTaskWindowVisible: false,
            isCreateBirthdayWindowVisible: false,
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

    },

    actions: {



    }
}
