<template>
  <div>
    <button @click="test">
      退出
    </button>
    <pagination :table-data.sync="tableData" :pagination="pagination"  :buttons="buttons"  :columns="columns" @change="change" >

    </pagination>
  </div>

</template>
<script>
  //引入分页组件
  import pagination from './pagination.vue'
  //继承组件
  import extend from './extend.vue'

  export default {
    extends:extend,
    data() {
      return {
        //分页显示的数据
        tableData:[],
        //分页显示的列
        columns:[
          {
            //column的prop
            prop:'order_on',
            //column的label
            label:'订单号',
            //column的fixed boolean
            fixed:true,
            //column的sortable boolean 是否可排序
            sortable:true,
            //width 列的宽度
            width:100
          },
          {
            prop:'payment_method',
            label:'支付方式'
          },
          {
            prop:'status',
            label:'状态'
          }
        ],
        buttons:[
          {
            name:'修改',
            function(index, row) {
              console.log(row[index])
            }
          },
          {
            name:'删除',
            function(index, row) {
              console.log(row[index])
            }
          }
        ],
        page:1,
        pageSize:10,
        pagination:{}
      }
    },
    components:{pagination},
    created() {
      this.selectTableData()
    },
    methods:{
      test() {
        this.$store.dispatch('signout')
      },
      selectTableData() {
        this.page = parseInt(this.$route.query.page)
        this.query('order_search_with_page',
          {
            'page':parseInt(this.$route.query.page),
            'pageSize':this.$route.query.pageSize
          }
        )
      },

      change(page, size) {
        this.page = page
        this.pageSize = size
        this.setPage()
      },

      setPage() {
        this.routerPush( '/',
          {
            'page':this.page,
            'pageSize':this.pageSize
          }
        )
      }
    },
    watch:{
      '$route'(to, from) {
        this.selectTableData()
      }
    }
  }
</script>
