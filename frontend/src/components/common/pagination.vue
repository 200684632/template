<template>
  <div>
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
        :formatter="column.formatter || defaultFormatter"
      >
      </el-table-column>
      <el-table-column>
        <template scope="scope">
          <el-button
            v-for="button in buttons"
            :key="button.name"
            :type="button.type || 'primary'"
            :size="button.size || 'small'"
            :icon="button.icon || ''"
            @click="button.operation(scope.$index)">
            {{ button.name }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-button
      v-for="batch in batches"
      :key="batch.name"
      :type="batch.type || 'primary'"
      :size="batch.size || 'small'"
      :icon="batch.icon || ''"
      @click="batch.operation(selectIds)"
    >
      {{ batch.name }}
    </el-button>
    <el-pagination
      v-if="pagination.total>pagination.per_page"
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
    name:'pagination',
    data() {
      return {
        currentPage:1,
        pageSize:10,
        selectIds:[]
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
      pagination:Object,
      batches:{
        type:Array,
        default:[]
      }
    },
    created() {
      this.currentPage = parseInt(this.$route.query.page) || 1
      this.pageSize = parseInt(this.$route.query.pageSize) || 10
    },
    methods: {
      selectChange(selections) {
        selections.forEach(selection => {
            if(this.selectIds.indexOf(selection.id) === -1)
            {
              this.selectIds.push(selection.id)
            }
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
      unique() {

      }
    }
  }
</script>
