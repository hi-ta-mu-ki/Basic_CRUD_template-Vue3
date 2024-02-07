<script setup>
import {reactive,ref,onMounted} from 'vue'
import axios from 'axios';
import {ElNotification} from 'element-plus'
import { trim } from 'lodash';

const form=reactive({
    id:null,
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const password = ref('');
const password_confirmation =ref('');
const password_current = ref('');

const getUser = ()=>{
    axios.get('/api/auth/user')
    .then((res)=>{
        form.id=res.data.id;
        form.name=res.data.name;
        form.email=res.data.email;
    })
    .catch((error)=>{
        console.log('error '+error);
    });
}

const updateUser =()=>{
    if(trim(form.name)==''||trim(form.email)==''){
        ElNotification({
            title: 'Error',
            message: 'name,e-mailは省略できません',
            type: 'error',
        });
        return;
    }

    axios.patch('/api/auth/update',
        {
            'name':form.name,
            'email':form.email
        }).then((res)=>{
            console.log('user update success');
            ElNotification({
                title: 'Success',
                message: 'プロファイルの更新に成功しました',
                type: 'success',
            })
        }).catch((error)=>{
            console.log('error '+error);
            ElNotification({
                title: 'Error',
                message: 'プロファイルの更新に失敗しました',
                type: 'error',
            })
        })
}

const changePassword = ()=>{
    axios.put('/api/auth/password',
        {
            'current_password':password_current.value,
            'password':password.value,
            'password_confirmation':password_confirmation.value
        }).then((res)=>{
            console.log('password change success');
            ElNotification({
                title: 'Success',
                message: 'パスワードの更新に成功しました',
                type: 'success',
            })
        }).catch((error)=>{
            console.log('error '+error);
            ElNotification({
                title: 'Error',
                message: 'パスワードの更新に失敗しました',
                type: 'error',
            })
        });
}

onMounted(()=>{
    getUser();
})

</script>

<template>
    <el-row>
    <el-card>
    <el-form :model="form">
        <el-form-item label="id" :label-width="140">
            {{ form.id  }}
        </el-form-item>
        <el-form-item label="name" :label-width="140">
            <el-input v-model="form.name" autocomplete="off" />
        </el-form-item>
        <el-form-item label="e-mail" :label-width="140">
            <el-input v-model="form.email" autocomplete="off" />
        </el-form-item>
        <div align="right">
            <el-button @click="updateUser" type="primary" >更新</el-button>
        </div>
    </el-form>
    </el-card>
    </el-row>
    <el-row>
    <el-card>
    <el-form>
        <el-form-item label="現在のパスワード" :label-width="180" >
            <el-input v-model="password_current" autocomplete="off" type="password"/>
        </el-form-item>
        <el-form-item label="新規パスワード" :label-width="180" >
            <el-input v-model="password" autocomplete="new-password" type="password"/>
        </el-form-item>
        <el-form-item label="新規パスワード(再入力)" :label-width="180" >
            <el-input v-model="password_confirmation" autocomplete="off" type="password"/>
        </el-form-item>
        <div align="right">
            <el-button @click="changePassword" type="primary" >パスワード更新</el-button>
        </div>
    </el-form>
    </el-card>
    </el-row>
</template>
<style>
.el-row {
    margin-bottom: 20px;
}
</style>