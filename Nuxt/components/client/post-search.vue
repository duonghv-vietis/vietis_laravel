<template slot="header" slot-scope="scope">
    <div>
        <el-input
        size="mini"
        v-model="search"
        placeholder="Type to search"
        @keyup.enter.native="submitSearch"
        />
    </div>
</template>

<script>
export default {
    data (){
        return{
            search: ''
        }
    },

    methods: {
        async submitSearch () {
            let searchResult = []
            await this.$axios.$get(`posts/search/?data=${this.search}`)
                  .then(function (res) {
                      searchResult = res
                  })
            this.$emit('displaySearchResult', searchResult)
        }
    }

}
</script>