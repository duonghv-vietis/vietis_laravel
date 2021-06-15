<template>
    <el-row type="flex" class="row-bg" justify="center">
        <el-col :span="18">
            <h2 align="center">Sửa bài viết</h2>
            <notifications group="foo" position = 'top right'/>
            <br />
            <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label-width="120px" label="Form" class="demo-ruleForm">
                <el-form-item label="Tiêu đề" prop="title">
                    <el-input type="text" v-model="ruleForm.title" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item label="Tác giả" prop="author">
                    <el-input type="text" v-model="ruleForm.author" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm')">Submit</el-button>
                    <el-button @click="resetForm('ruleForm')">Reset</el-button>
                </el-form-item>
            </el-form>
        </el-col>
    </el-row>
</template>

<script>
  import Vue from 'vue'
  import axios from 'axios';

  export default {
    data() {
        var validateTitle = (rule, value, callback) => {
            if (!value) {
                return callback(new Error('Hãy nhập tiêu đề bài viết !'));
            } else {
                callback();
            }
        };
        var validateAuthor = (rule, value, callback) => {
            if (value === '') {
            callback(new Error('Hãy nhập tên tác giả'));
            } else {
              callback();
            }
        };

        return {
            ruleForm: {
              title : this.$route.params.row['title'],
              author: this.$route.params.row['author']
            },

            rules: {
                title : [
                  { validator: validateTitle, trigger: 'blur' }
                ],

                author : [
                  { validator: validateAuthor, trigger: 'blur' }
                ],
            }
      };
    },

    created() {
      //
    },

    methods: {
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            let title = this.ruleForm.title;
            let author = this.ruleForm.author;
            this.$axios.$patch(`posts/${ this.$route.params.row['id'] }`, {
                title: title,
                author: author
            })
            .then(function (response){
              console.log(response);
              Vue.notify({
                group: 'foo',
                title: 'Thành công',
                text: 'Sửa bài viết thành công !'
              })
              window.history.back();
            });
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },

      resetForm(formName) {
        this.$refs[formName].resetFields();
      }
    }
  }
</script>
