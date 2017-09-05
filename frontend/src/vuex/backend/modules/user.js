import api from '../api'
import settings from '~/conf/settings'

const state = {
  me: {},
  token: {},
  token_loaded: false,
  user_loaded: false, 
}

const not_expired = (token) => {
  let endTime = token.created_at + token.expires_in - 10
  return endTime > parseInt(new Date().getTime() / 1000)
}

const valid_token = (token) => {
  return !!token && !!token.access_token && not_expired(token)
}

const getters = {
  user_authorized: state => valid_token(state.token)
}

const actions = {
  signin({commit, dispatch}, {username, password}) {
    let params = {
      username: username, 
      password: password,
      grant_type: 'password',
      client_id: settings.passport_client_id,
      client_secret: settings.passport_client_secret
    }
    api.post(api.url('token'), params)
       .then((ret) => {
          if (ret.error) {
            dispatch('error', {errmsg: '用户名密码错误或不存在'})
          } else {
            ret.created_at = Math.round(+new Date()/1000);
            let store = window.localStorage;
            store.setItem('backend_token', JSON.stringify(ret))
            commit('token_loaded', ret)
            dispatch('load_user')
          }
       })
  },

  signout({commit}) {
    window.localStorage.removeItem('backend_token')
    commit('signout')
  },

  user_register({commit}, {mobile, password}) {
    return api.post(api.url('register'), {mobile, password})
  },

  load_token({commit, dispatch}) {
    let ret = new Promise((resolve, reject) => {
      let store = window.localStorage;
      let token = {}
      try {
        token = JSON.parse(store.getItem('backend_token'))
      } catch (e) {}
      if (!valid_token(token)) {
        commit('token_loaded', {})
        reject('')
      } else {
        commit('token_loaded', token)
        resolve(token)
      }
    });
    
    return ret
  },

  load_user({commit, dispatch}) {
    api.get(api.url('user_me')).then(ret => {
      if (ret.success) {
        commit('user_loaded', ret.user);
      } else {
        dispatch('signout')
      }
    })
  },
}

const mutations = {
  user_loaded(state, me) {
    state.me = me
    state.user_loaded = true
  },
  token_loaded(state, token) {
    state.token = token
    state.token_loaded = true
  },

  signout(state) {
    state.token = {}
    state.me = {}
    state.token_loaded = true
    state.user_loaded = false
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}