import Pagination from './pagination.vue'
import commonApi from './commonApi'

const components = [
  Pagination
]

const install = (Vue, opts = {}) => {
  Vue.prototype.$query = new commonApi()
  components.map((component) => {
    Vue.component(component.name, component)
  })
}



export default {
  install
}
