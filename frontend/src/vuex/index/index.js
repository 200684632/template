import Vue from 'vue'
import Vuex from 'vuex'

import app from './modules/app'
import user from './modules/user'

Vue.use(vuex)
const getters = {}

export default new Vuex.store({
	getters,
	modules:{
		app,user
	},
	strict: true
})