<template>
<div class="back_login">
  <div class="back_login_panel">
    <div class="login_inputs">
      <div class="login_logo">管理后台登陆</div>
        <el-input size="large" v-model="username" placeholder="请输入手机号或者邮箱"></el-input>
        <el-input type="password" size="large" v-model="password" placeholder="请输入登录密码"></el-input>
        <el-button type="primary" size="large" class="btn_login_back mt_10" @click="submit">登录</el-button>
    </div>
    <lx-table :datas="data" :columns="columns" :operations="operation" @handleCurrentChange="changeL">
    </lx-table>
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
        user: 'test'
      }, {
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
      operation: [{
        type: 'primary',
        name: '编辑',
        handler(index, row) {
          alert(index)
        }
      }, {
        type: 'danger',
        name: '删除',
        handler(index, row) {
          alert(index)
        }
      }]
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
    }
  }
}
</script>

<style>
</style>
