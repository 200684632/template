<template>
  <div class="table-wrapper">
    <div class="table-container">
      <el-table
        :data="tableData"
        @selection-change="selectChange"
        style="width: 100%">
        <el-table-column type="selection" width="50">
        </el-table-column>
        <el-table-column
          v-for="column in columns"
          :key="column.prop"
          :fixed="column.fixed || ''"
          :prop="column.prop"
          :label="column.label"
          :width="column.width"
          :sortable="column.sortable || false"
          :align="column.align || 'center'"
          :formatter="column.formatter || defaultFormatter">
        </el-table-column>
        <el-table-column align="center" label="操作">
          <template scope="scope">
            <el-button
              v-for="button in buttons"
              :key="button.name"
              :type="button.type || 'primary'"
              :size="button.size || 'small'"
              :icon="button.icon || ''"
              @click="clickMethod(button.operation, scope.$index, scope.row)">
              {{ button.name }}
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="pagination-container">
      <el-pagination
        v-if="pagination.total > pagination.per_page"
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
        :current-page.sync="currentPage"
        :page-sizes="[10, 20, 30, 40]"
        :page-size="pageSize"
        layout="sizes, prev, pager, next"
        :total="pagination.total">
      </el-pagination>
    </div>
  </div>
</template>
<script>
  export default{
    name:'pagination',
    data() {
      return {
        currentPage: 1,
        pageSize: 10,
        selected: []
      }
    },
    props:{
      tableData: {
        type: Array,
        default: [],
      },
      columns: {
        type: Array,
        default: []
      },
      buttons: {
        type: Array,
        default: []
      },
      pagination: Object,
      batches: {
        type: Array,
        default: function() {
          return []
        }
      }
    },
    created() {
      this.currentPage = parseInt(this.$route.query.page) || 1
      this.pageSize = parseInt(this.$route.query.pageSize) || 10
    },
    methods: {
      selectChange(selections) {
        this.batches.forEach(v => {
          this.$delete(this.batches, v)
        })

        selections.forEach((selection, index) => {
          this.$set(this.batches, index, selection.id || index)
        })
      },
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
      },
      defaultFormatter(row ,column, cellValue) {
        return row[column.property]
      },
      clickMethod(method, index, row) {
        method(index, row, this)
      }
    }
  }
</script>

<style>
  .pagination-container {text-align: center; margin-top: 20px;}
</style>
