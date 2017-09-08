<template>
  <div class="table-wrapper">
    <div class="table-container">
      <el-table
        :data="datas.data || datas"
        :border="true">
        <el-table-column
          type="selection"
          width="55"
          v-if="checkBox">
        </el-table-column>
        <el-table-column
          v-for="column in columns"
          :fixed="column.fixed || false"
          :label="column.label"
          :prop="column.prop"
          :width="column.width || 'auto'"
          :key="column.value || ''"
          :sortable="column.sortable || false"
          :class-name="column.className || ''"
          :formatter="column.formatter || defaultFormatter"
          align="center">
        </el-table-column>
        <el-table-column label="操作" align="center" v-if="showOperation">
          <template scope="scope">
            <el-button
              v-for="action in operations"
              :type="action.type || ''"
              :icon="action.icon || ''"
              size="small"
              @click="action.handler(scope.$index, scope.row, scope.column, scope.store)">
              {{ action.name }}
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="pagination-wrapper">
      <el-pagination
        @current-change="handleCurrentChange"
        :current-page="1"
        :page-size="100"
        layout="total, prev, pager, next"
        :total="1000"
        v-if="showPagination">
      </el-pagination>
      <el-pagination
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
        :current-page.sync="currentPage"
        :page-sizes="[10, 20, 30, 40]"
        :page-size="pageSize"
        layout="sizes, prev, pager, next"
        :total="pagination.total"
        v-if="showPagination">
      </el-pagination>
    </div>
  </div>
</template>

<script type="text/babel">
  export default {
    name: 'LxTable',

    data() {
      return {
        currentPage: 1,
        pageSize: 10
      }
    },
    props: {
      datas: {
        type: Array,
        default: function() {
          return []
        }
      },
      height: [String, Number],
      checkBox: {
        type: Boolean,
        default: true
      },
      columns: {
        type: Array
      },
      operations: {
        type: Array,
        default() {
          return []
        }
      },
      pagination: {
        type: Object,
        default() {
          return {
            total: 0
          }
        }
      }
    },
    computed: {
      showOperation() {
        return this.operations.length > 0
      },
      showPagination() {
        return this.pagination.total > this.pageSize
      }
    },
    methods: {
      handleCurrentChange(page) {
        this.page = page
        this.emit()
      },
      handleSizeChange(size) {
        this.pageSize = size
        this.emit()
      },
      emit() {
        this.$emit('change', this.pageSize, this.page)
      },
      defaultFormatter(column, row) {
        return column[row.property]
      }
    }
  }
</script>

<style type="text/css">
  .pagination-wrapper {text-align: center; margin-top: 20px;}
</style>
