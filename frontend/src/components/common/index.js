import Table from '~/components/common/table.vue'

const components = [
  Table
]

const install = (Vue, opts = {}) => {
  components.map((component) => {
    Vue.component(component.name, component)
  })
}

export default {
  install,
  Table
}
