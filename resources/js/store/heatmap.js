export default {
    namespaced: true,

    state() {
        return {
            reload: false,
        }
    },

    actions: {
        setReload({commit}, bool) {
            commit({type: 'setReload', value: bool});
        },
    },

    mutations: {
        setReload(state, {value}) {
            state.reload = value;
        }
    },

    getters: {
        getReload(state) {
            return state.reload;
        },
    }
}