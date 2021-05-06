export default {

    state() {
        return {
            titleModalMessage: '',
            bodyModalMessage: ''
        }
    },

    getters: {

        titleModalMessage(state) {
            return state.titleModalMessage
        },

        bodyModalMessage(state) {
            return state.bodyModalMessage
        },

    },

    mutations: {

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
