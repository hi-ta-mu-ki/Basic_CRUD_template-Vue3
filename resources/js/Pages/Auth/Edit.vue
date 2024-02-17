<script setup>
import {reactive,ref,defineEmits} from 'vue'
import axios from 'axios';
import {ElNotification} from 'element-plus'
import { trim } from 'lodash';
import USER_ROLE from "../../const"

const emit = defineEmits(['reLoad']);
const isVisible=ref(false);
const form=reactive({
    id:null,
    name: '',
    email: '',
    role: '',
    password: '',
    password_confirmation: '',
});

const password = ref('');
const password_confirmation =ref('');
const password_current = ref('');

const updateUser =()=>{
    if(trim(form.name)==''||trim(form.email)==''){
        ElNotification({
            title: 'Error',
            message: 'name, e-mail, or role is null',
            type: 'error',
        });
        return;
    }

    axios.patch('/api/auth/update/'+form.id,
        {
            'id':form.id,
            'name':form.name,
            'email':form.email,
            'role':form.role
        }).then((res)=>{
            console.log('user update success');
            ElNotification({
                title: 'Success',
                message: 'updated',
                type: 'success',
            })
            emit('reLoad');
        }).catch((error)=>{
            console.log('error '+error);
            console.log(form);
            ElNotification({
                title: 'Error',
                message: 'not updated',
                type: 'error',
            })
        })
}

const changePassword = ()=>{
    axios.put('/api/auth/password/'+form.id,
        {
            'id':form.id,
            'current_password':password_current.value,
            'password':password.value,
            'password_confirmation':password_confirmation.value
        }).then((res)=>{
            console.log('password change success');
            ElNotification({
                title: 'Success',
                message: 'Updated.',
                type: 'success',
            })
        }).catch((error)=>{
            console.log('error '+error);
            ElNotification({
                title: 'Error',
                message: 'Not updated.',
                type: 'error',
            })
        });
}

const open=(item)=>{
    form.id=item.id;
    form.name=item.name;
    form.email=item.email;
    form.role=item.role;
    isVisible.value=true;
}
defineExpose({
    open,
})

</script>

<template>
    <el-dialog v-model="isVisible" title="user edit">
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
                <el-form-item label="role" :label-width="140">
                    <el-radio-group v-model="form.role">
                        <el-radio :label=USER_ROLE.admin>admin</el-radio>
                        <el-radio :label=USER_ROLE.user>user</el-radio>
                    </el-radio-group>
                </el-form-item>
                <div align="right">
                    <el-button @click="updateUser" type="primary" >update</el-button>
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
    </el-dialog> 
</template>
<style>
.el-row {
    margin-bottom: 20px;
}
</style>