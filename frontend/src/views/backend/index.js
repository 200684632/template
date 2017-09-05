import Vue from 'vue'
import { sync } from 'vuex-router-sync'

import ElementUI from 'element-ui'
import App from '~/components/Backend.vue'
import store from '~/vuex/backend/index'
import router from '~/routers/backend'

Vue.use(ElementUI)
sync(store, router)

new Vue ({
	el: '#app',
	router,
	store,
	render: h => h(App)
}) 
