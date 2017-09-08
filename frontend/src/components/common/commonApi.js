class pageApi {

  query(api,params, self) {
    self.$store.dispatch(api, params).then((ret)=>{
      self.tableData=ret.orders.data
      self.pagination=ret.orders.meta.pagination
    })
  }

  routerPush(url,params, self) {
    self.$router.push({path:url, query:params})
  }
}

export default pageApi
