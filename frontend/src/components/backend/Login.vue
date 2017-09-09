<template>
<div class="back_login">
  <div class="back_login_panel">
    <div class="login_inputs">
      <div class="login_logo">管理后台登陆</div>
        <el-input size="large" v-model="username" placeholder="请输入手机号或者邮箱"></el-input>
        <el-input type="password" size="large" v-model="password" placeholder="请输入登录密码"></el-input>
        <el-button type="primary" size="large" class="btn_login_back mt_10" @click="submit">登录</el-button>
    </div>
    <el-button @click="getAllChosen">获取选中</el-button>
    <pagination
      :tableData="data"
      :columns="columns"
      :buttons="operations"
      :pagination="pagination"
      :batches.sync="batches">

    </pagination>
  </div>

  <div class="bottom_back_login">
    <p class="cp_txt">&copy 2017 abaoda.com 版权所有</p>
  </div>
</div>
</template>

<script>
import backendApi from '~/vuex/backend/api'

export default {
  data() {
    return {
      username: '',
      password: '',
      data: [{
        id: 1,
        user: 'test'
      }, {
        id: 2,
        user: 'demo'
      }],
      columns: [{
        label: '用户名',
        prop: 'user',
        formatter: function(column, row) {
          if (column[row['property']] === 'test') {
            return '管理员'
          } else {
            return column[row['property']]
          }
        }
      }],
      operations: [{
        type: 'primary',
        name: '编辑',
        operation: function(index, row, self) {
          console.log(self.$route.name)
        }
      }, {
        type: 'danger',
        name: '删除',
        operation: function(index, row, self) {
          console.log(index, row, self)
        }
      }],
      pagination: {
        total: 12,
        per_page: 1
      },
      batches: []
    }
  },
  methods: {
    submit() {
      this.$store.dispatch('signin', {username: this.username, password: this.password})
    },
    test(index) {
      alert(index)
    },
    changeL: function (page) {
      console.log(page)
    },
    getAllChosen() {
      console.log(this.batches)
    }
  },
  async created() {
    try {
      let res = await backendApi.get('http://127.0.0.1:9099/api/test')

      console.log(res)
    } catch (e) {

    }
  }
}
</script>

<style>
</style>
