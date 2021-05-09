export default {

    state() {
        return {
            valueDeleteIdEvent: null,
            valueDeleteTypeEvent: null,
        }
    },

    getters: {

        valueDeleteIdEvent(state) {
            return state.valueDeleteIdEvent
        },
        valueDeleteTypeEvent(state) {
            return state.valueDeleteTypeEvent
        },

    },

    mutations: {

        setValueDeleteIdEvent(state, value) {
            state.valueDeleteIdEvent = value
        },
        setValueDeleteTypeEvent(state, value) {
            state.valueDeleteTypeEvent = value
        },

    },

    actions: {



    }
}
