import axios from 'axios'
import store from '~/vuex/backend/index'
import settings from '~/conf/settings'

const base = settings.backend_api_base

const endpoints = {
	'token': '/backend/oauth/token',
  'user_me': '/backend/users/me',
}

const request = (method, url, params) => {
  let config = {
    url: url,
    method: method,
  }

  if (method == 'get') {
    config.params = params
  } else {
    config.data = params
  }

  const user = store.state.user
  if (store.getters.user_authorized) {
    config.headers = {'Authorization': 'Bearer ' + user.token.access_token}
  }

  return axios.request(config).then((response) => {
    return response.data
  }).catch((error) => {
    if (error.response.status == 401) {
      if (error.response.data.error == 'invalid_credentials') {
        return error.response.data
      }
      store.dispatch('signout')
      return
    }
    if (error.response.data) {
        return error.response.data
    } else {
      return {error: '接口访问出错'}
    }
  })
}

class Api {
  constructor (base, endpoints) {
    this.base = base
    this.endpoints = endpoints
  }

  url (endpoint_name, ...args) {
    let endpoint = this.endpoints[endpoint_name]
    if (!endpoint) {
      throw Error('endpoint not foud!')
    }
    if (args.length > 0) {
      let i = 0
      let arg
      while ((arg = args.shift())) {
        i++
        endpoint = endpoint.replace('{' + i + '}', arg)
      }
    }
    return this.base + endpoint
  }

  get (url, params) {
    return request('get', url, params)
  }

  post (url, params) {
    return request('post', url, params)
  }

  patch (url, params) {
    return request('patch', url, params)
  }

  delete (url, params) {
    return request('delete', url, params)
  }

  put (url, params) {
    return request('put', url, params)
  }
}

export default new Api(base, endpoints)