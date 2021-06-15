<template>
  <div>
    <el-row type="flex" justify="center">
      <el-col :span="18">
        <div>
          <h1>Nuxt Posts</h1>
          <br />

          <!-- Button show create post form-->
          <create-button :posts="posts" :pagination="pagination" @loadLastPage="loadLastPage"></create-button>

          <!-- PostListComponent-->
          <post-list :posts="posts" :listLoading="listLoading" :pagination="pagination" :search="search"
            @paginationFromDelBtn="handlePaginationFromDelete"
            @reloadCurrentPageAfterEdit="reloadCurrentPage"
            @showSearchResultToIndex="showSearchResultToIndex">
          </post-list>
        </div>
      </el-col>
    </el-row>
    <br />
      <!-- Pagination bar -->
      <pagination :pagination="pagination" @pagination="handlePagination"></pagination>

    <br />
  </div>
</template>

<script>
  import Vue from 'vue'
  import router from 'vue-router'
  import Pagination from './post-pagination.vue'
  import PostList from './post-list.vue'
  import CreateButton from './post-create.vue'

  Vue.use(router)

  export default {
    //Define data
    data() {
      return {
        posts: [],
        counter: 0,
        pagination: {
          total: 0,
          per_page: 2,
          from: 1,
          to: 0,
          current_page: 1,
          last_page: 1
        },
        search: '',
        listLoading: true,
      }
    },

    components : {
      Pagination, PostList, CreateButton
    },

    computed: {
      current_page () {
        return this.pagination.current_page
      },

      paginationData() {
        return this.pagination.data
      }
    },

    async created() {
      this.listLoading = true
      await this.$axios.$get(`posts?page=${this.pagination.current_page}`)
        .then((response) => {
          this.posts = response.data
          this.pagination = response
      })

      //Set timeout v-loading
      setTimeout(() => {
        this.listLoading = false
      }, 0.3 * 1000)

    },

    watch: {
      //Load pagination
      current_page () {
        this.reloadCurrentPage();
      },
    },

    methods: {

      //Handle pagination
      handlePagination (params) {
        this.pagination.current_page = params.page
      },

      //Handle paginationfrom Delete btn
      handlePaginationFromDelete (params) {
        if (this.posts.length == 0 && this.pagination.last_page >= 2) {
          this.pagination.current_page = this.pagination.last_page - 1
        }
        this.reloadCurrentPage()

        setTimeout(() => {
          this.$notify({
            group: 'foo',
            title: 'Thành công',
            text: 'Xóa bài viết thành công !'
          })
        }, 1 * 1000)
      },

      //Reload curent page
      async reloadCurrentPage() {
        await this.$axios.$get(`posts?page=${this.pagination.current_page}`)
        .then((response) => {
          this.posts = response.data
          this.pagination = response
        })

        this.listLoading = true

        //Set timeout v-loading
        setTimeout(() => {
          this.listLoading = false
        }, 0.5 * 1000)
      },

      //Load last page after create
      async loadLastPage() {
        this.reloadCurrentPage()

        setTimeout(() => {
          Vue.notify({
            group: 'foo',
            title: 'Thành công',
            text: 'Đã tạo mới bài viết'
          })
        }, 1 * 1000)
      },

      //showSearchResultToIndex
      showSearchResultToIndex(params) {
        console.log(params)
        this.posts = params.data
      }
    },

  }
</script>

