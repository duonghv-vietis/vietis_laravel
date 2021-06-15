<template>
<ul class="pagination">
  <el-pagination
  background
  align=center
  layout="prev, pager, next, jumper"
  :total="pagination.total"
  @current-change="handleCurrentChange"
  >
</el-pagination>
  </ul>
</template>

<script>
  export default {
    props: {
      pagination: {
        type: Object,
        required: true
      },
    },

    computed: {
      //
    },

    methods: {
      //change current Page
      handleCurrentChange (val) {
        this.$emit('pagination', {page: val})
      }

    },
  }
</script>
