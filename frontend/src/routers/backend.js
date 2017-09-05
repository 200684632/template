import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '~/vuex/backend/index'
import routes from './backend.routes'

Vue.use(VueRouter);

const router = new VueRouter({
  history: true, 
  saveScrollPosition: true, 
  routes
});

const auth_filter = (to, from, next) => {
  let requireNoLogin = ['login'].indexOf(to.name) > -1
  let authorized = store.getters.user_authorized
  if (authorized) {
    if (requireNoLogin) {
      next('/')
    } else {
      next()
    }
  } else {
    if (requireNoLogin) {
      next()
    } else {
      next('/login')
    }
  }
}

router.beforeEach((to, from, next) => {
  if (!store.getters.app_initialized) {
    let w = store.watch((state, getters) => {
      return getters.app_initialized
    }, () => {
      auth_filter(to, from, next)
    })
    store.dispatch('app_initialize')
  } else {
    auth_filter(to, from, next)
  }
});


export default router;
