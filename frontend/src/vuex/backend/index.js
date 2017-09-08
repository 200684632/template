import Vue from 'vue'
import Vuex from 'vuex'

import app from './modules/app'
import user from './modules/user'
Vue.use(Vuex)

const getters = {}

export default new Vuex.Store({
	getters,
	modules: {
		app, user
	},
	strict: true,
})
