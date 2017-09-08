<template>
  <div>
    <el-table
      :data="tableData"
      style="width: 100%">
      <el-table-column :type="type" width="50">
      </el-table-column>
      <el-table-column
        v-for="column in columns"
        :fixed="column.fixed"
        :prop="column.prop"
        :label="column.label"
        :width="column.width"
        :sortable="column.sortable">
      </el-table-column>
      <el-table-column>
        <template scope="scope">
          <el-button v-for="button in buttons" @click="button.function(scope.$index, tableData)">
            {{ button.name }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-pagination
      @size-change="handleSizeChange"
      @current-change="handleCurrentChange"
      :current-page.sync="currentPage"
      :page-sizes="[10, 20, 30, 40]"
      :page-size="pageSize"
      layout="sizes, prev, pager, next"
      :total="pagination.total">
    </el-pagination>
  </div>
</template>
<script>
  export default{
    data() {
      return {
        currentPage:1,
        pageSize:10
      }
    },
    props:{
      tableData:{
        type:Array,
        default:[],
      },
      columns:{
        type:Array,
        default:[]
      },
      buttons:{
        type:Array,
        default:[]
      },
      type:{
        type:String,
        default:'selection'
      },
      pagination:Object
    },
    created() {
      this.currentPage = parseInt(this.$route.query.page) || 1
      this.pageSize = parseInt(this.$route.query.pageSize) || 10
    },
    methods:{
      handleSizeChange(size) {
        this.pageSize = size
        this.emit()
      },
      handleCurrentChange(page) {
        this.currentPage = page
        this.emit()
      },
      emit() {
          this.$emit('change', this.currentPage, this.pageSize)
      }
    }
  }
</script>
