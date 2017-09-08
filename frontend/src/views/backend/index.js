import Vue from 'vue'
import { sync } from 'vuex-router-sync'

import ElementUI from 'element-ui'
import App from '~/components/Backend.vue'
import store from '~/vuex/backend/index'
import router from '~/routers/backend'
import 'element-ui/lib/theme-default/index.css'
import Common from '~/components/common/index'

Vue.use(ElementUI)
Vue.use(Common)
sync(store, router)

new Vue ({
	el: '#app',
	router,
	store,
	render: h => h(App)
})
