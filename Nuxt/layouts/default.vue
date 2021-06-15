<template>
  <div id="app">
    <el-row type="flex" class="row-bg" justify="center">
      <el-col :span="18">
        <el-menu
          mode="horizontal"
          background-color="#545c64"
          text-color="#fff"
          active-text-color="#ffd04b">
          <el-menu-item index="1">Homepage</el-menu-item>
          <el-submenu index="2">
            <template slot="title">Workspace</template>
            <el-menu-item index="3">VietIS</el-menu-item>
            <el-menu-item index="3">Sun Asterisk</el-menu-item>
          </el-submenu>
          <el-menu-item index="3" disabled>Info</el-menu-item>
          <el-menu-item index="4"><a href="youtube.com" target="_blank">Go to Admin</a></el-menu-item>
        </el-menu>
      </el-col>
    </el-row>
    <!-- <slider :width="300" format="push" direction="left" :opacity="0.15" :links="[{'id': 1, 'text': 'Link 1', 'url': 'https://github.com'}, {'id': 2, 'text': 'Link 2', 'url': 'https://github.com'}]"></slider> -->
    <notifications group="foo" position = 'top right'/>
    <Nuxt />
    <!-- <div>My footer</div> -->
  </div>
</template>

<script>
import Vue from 'vue'
import router from 'vue-router'
// import slider from '@jeremyhamm/vue-slider'
Vue.use(router)
export default {
  components: {
    // slider
  }
}
</script>
<style>
html {
  font-family:
    'Source Sans Pro',
    -apple-system,
    BlinkMacSystemFont,
    'Segoe UI',
    Roboto,
    'Helvetica Neue',
    Arial,
    sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}

.row-bg {
  font-weight: 600;
}
</style>
