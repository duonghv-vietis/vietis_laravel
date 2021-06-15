<template>
    <el-button
        size="mini"
        type="danger"
        @click="handleDelete(scope.row)">Delete
    </el-button>
</template>

<script>
export default {
    props: ['scope', 'posts', 'pagination'],

    methods: {
      //Handler delete records
        async handleDelete(row) {
            let status
            if(confirm('Bạn có muốn xóa không?')){
            await this.$axios.$delete(`posts/${ row['id'] }`,{
                //param here
                }).then(function (response) {
                    status = response['deleted'];
                });
                if(status === true) {
                    const idx = this.posts.indexOf(row)
                    this.posts.splice(idx, 1)

                    this.$emit('updatePageAfterDelete', this.posts)
                } else {
                    this.$notify({
                        group: 'foo',
                        type: 'warn',
                        title: 'Thất bại',
                        text: 'Xóa bài viết không thành công !'
                    })
                }
            }
        },
    }
}
</script>
