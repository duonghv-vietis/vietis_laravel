<template>
  <div>
    <el-row type="flex" class="row-bg" justify="center">
      <el-col :span="18">
        <div>
          <h1>Nuxt Posts</h1>
          <br />
          <NuxtLink to="/posts/create" class="no-decoration" >
            <el-button size="mini" type="success">
              Tạo vài viết mới
            </el-button>
          </NuxtLink>
          <el-table
            :data="posts.filter(data => !search || data.title.toLowerCase().includes(search.toLowerCase()) || data.author.toLowerCase().includes(search.toLowerCase()))"
            style="width: 100%">
            <el-table-column
              align="center"
              label="#"
              type="index"
              width="77">
            </el-table-column>
            <el-table-column label="Tiêu đề" prop="title"></el-table-column>
            <el-table-column label="Tác giả" prop="author"></el-table-column>
            <el-table-column align="right">
            <template slot="header" slot-scope="">
              <el-input
              size="mini"
              v-model="search"
              placeholder="Type to search"/>
            </template>
            <template slot-scope="scope">
                <el-button
                  size="mini"
                  @click="handleEdit(scope.row)">Edit
                </el-button>
                <el-button
                  size="mini"
                  type="danger"
                  @click="handleDelete(scope.row)">Delete
                </el-button>
            </template>
            </el-table-column>
          </el-table>
        </div>
      </el-col>
    </el-row>
    <br />
      <post-pagination></post-pagination>
    <br />
  </div>
</template>

<script>
  import Vue from 'vue'
  import router from 'vue-router'
  import post_pagination from '~/components/client/post-pagination.vue'
  // import { scrollTo } from '@/utils/scroll-to'

  Vue.use(router)

  export default {
    data() {
      return {
        posts: [],
        search: '',
        recordsPerPage: 7,
      }
    },

    components : {
      'post-pagination': post_pagination
    },

    computed: {
       currentPage: {
        get() {
          return this.page
        },
        set(val) {
          this.$emit('update:page', val)
        }
      },
      pageSize: {
        get() {
          return this.limit
        },
        set(val) {
          this.$emit('update:limit', val)
        }
      }
    },

    async created() {
      this.posts = await this.$axios.$get(`posts`)
      console.log(this.posts.length)
    },

    methods: {
      //Handle edit records
      handleEdit(row) {
        this.$router.push({ name: 'posts-edit', params: {row :row}})
      },

      //Handler delete records
      async handleDelete(row) {
        console.log(this.posts)
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
            this.$notify({
              group: 'foo',
              title: 'Thành công',
              text: 'Đã xóa bài viết !'
            })
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

      //Handle pagination
      handleSizeChange(val) {
        this.$emit('pagination', {page: this.currentPage, limit: val})
        // if (this.autoScroll) {
        //   scrollTo(0, 800)
        // }
      },

      handleCurrentChange(val) {
        this.$emit('pagination', {page: val, limit: this.pageSize})
        // if (this.autoScroll) {
        //   scrollTo(0, 800)
        // }
      }
    },
  }
</script>

