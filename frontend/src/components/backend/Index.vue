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
  export default {
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
            fixed:'right',
            //column的sortable boolean 是否可排序
            sortable:true,
            //width 列的宽度
            width:100,
            align:'right'
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
            test(index, row) {
              console.log(row[index])
            },
            icon:'edit',
            type:'success',
            size:'small'
          },
          {
            name:'删除',
            test(index, row) {
              console.log(row[index])
            },
            icon:'edit'
          }
        ],
        page:1,
        pageSize:10,
        pagination:{}
      }
    },
    created() {
      this.selectTableData()
    },
    methods:{
      test() {
        this.$store.dispatch('signout')
      },
      selectTableData() {
        this.page = parseInt(this.$route.query.page)
        let data = this.$query.query('order_search_with_page',
          {
            'page':parseInt(this.$route.query.page),
            'pageSize':this.$route.query.pageSize
          },
          this
        )
        console.log(data)

      },

      change(page, size) {
        this.page = page
        this.pageSize = size
        this.setPage()
      },

      setPage() {
        this.$query.routerPush( '/',
          {
            'page':this.page,
            'pageSize':this.pageSize
          },
          this
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
