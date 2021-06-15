<template>
  <div>
    <h2>Component cha</h2>
    <button v-on:click="parentPlus">Parent Count: {{ parentCount }}</button>
    <child :parentCount="parentCount" v-on:plusToParent="updateParentCount"></child>
  </div>
</template>

<script>
import child from './childComponent.vue'

export default {
  components : {
    child,
  },

  data () {
    return {
      parentCount: 0
    }
  },

  methods: {
    parentPlus : function () {
      this.parentCount +=1
    },

    parentNoti : function() {
      alert('Component con da goi !')
    },

    updateParentCount(val, val2) {
      this.parentCount = val
      console.log(val2)
    }
  }
}
</script>
