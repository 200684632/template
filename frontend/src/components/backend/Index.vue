<template>
  <div>backend/index
    {{ str }}
    <button @click="test">
      退出
    </button>
  </div>

</template>
<script>
  export default {
    data() {
      return {
        str:''
      }
    },
    created() {

    },
    methods:{
      test() {
        this.$store.dispatch('signout')
      }
    }
  }
</script>
