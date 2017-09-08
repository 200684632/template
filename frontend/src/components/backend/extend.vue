<script>
  export default {
    methods:{
      query(api, params) {
        this.selectTableList(api, params)
      },

      selectTableList(api,params) {

        this.$store.dispatch(api, params).then((ret)=>{
            console.log(ret)
          this.tableData=ret.orders.data
          this.pagination=ret.orders.meta.pagination

        })
      },
      routerPush(url,params) {
        this.$router.push({path:url, query:params})
      }
    }

  }
</script>
