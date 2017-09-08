import user from './user'

const state = {
    error: {},
}

const getters = {
    app_initialized(state, getters) {
        return (!getters.user_authorized && user.state.token_loaded) ||
               (getters.user_authorized && user.state.user_loaded)
    }
}

const actions = {

    error({dispatch, commit}, error) {
        commit('error_occurred', error)
    },
    app_initialize({dispatch, commit}) {
        dispatch('load_token').then(()=> {
            dispatch('load_user')
        }, () => {
        })
    },
}

const mutations = {
    error_occurred(state, error) {
        state.error = error
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
