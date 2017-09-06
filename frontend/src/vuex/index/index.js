import Vue from 'vue'
import Vuex from 'vuex'

import user from './modules/user'

Vue.use(vuex)
const getters = {}

export default new Vuex.store({
	getters,
	modules:{
		user
	},
	strict: true
})