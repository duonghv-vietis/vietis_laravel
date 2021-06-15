<template>
    <el-table
        v-loading="listLoading"
        :data="posts"
        style="width: 100%">
        <el-table-column
            align="center"
            label="#"
            type="index"
            :index="indexMethod"
            width="77">
        </el-table-column>
        <el-table-column label="Tiêu đề" prop="title"></el-table-column>
        <el-table-column label="Tác giả" prop="author"></el-table-column>
        <el-table-column align="right">
            <div slot="header" slot-scope="scope">
                <search-bar :scope="scope" @displaySearchResult="displaySearchResult"></search-bar>
            </div>
            <div slot-scope="scope">
                <el-col :span="18">
                    <!-- Edit component button -->
                    <edit-button :scope="scope" @reloadCurrentPage="reloadCurrentPage"></edit-button>
                </el-col >
                <el-col :span="6">
                    <!-- Delete component button -->
                    <delete-button :scope="scope" :posts="posts" :pagination="pagination" @updatePageAfterDelete="updatePageAfterDelete"></delete-button>
                </el-col>
            </div>
        </el-table-column>
    </el-table>
</template>

<script>
    import DeleteButton from './post-delete-btn.vue'
    import EditButton from './post-edit.vue'
    import SearchBar from './post-search.vue'

    export default {
        data() {
            return {
                //
            }
        },

        components :{
            DeleteButton, EditButton, SearchBar
        },

        props: ['posts', 'listLoading', 'search', 'pagination'],

        methods: {
            //Index method
            indexMethod (index) {
                return (this.pagination.current_page - 1) * this.pagination.per_page + index + 1
            },

            //Load curent Page after edit
            reloadCurrentPage () {
                this.$emit('reloadCurrentPageAfterEdit')
            },

            //Update pagination to Index
            updatePageAfterDelete (params) {
                this.$emit('paginationFromDelBtn', {newPosts: params})
            },

            //Display Search result
            displaySearchResult (params) {
                this.$emit('showSearchResultToIndex', params)
            }
        }
    }
</script>