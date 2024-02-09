<script setup>
import {reactive,ref,defineEmits} from 'vue'
import axios from 'axios';
import {ElNotification} from 'element-plus'
import { trim } from 'lodash';
import USER_ROLE from "../../const"

const isVisible=ref(false);
const emit = defineEmits(['reLoad']);

const form=reactive({
    name: '',
    email: '',
    role: '',
    password: '',
    password_confirmation: '',
});

const validate=()=>{

    console.log('email '+form.email);

    if(trim(form.name)==''||trim(form.email)==''||trim(form.role)==''||trim(form.password)==''){
        ElNotification({
            title: 'Error',
            message: 'name, e-mail, role or password is null',
            type: 'error',
        })
        return false;
    }

    if(form.password!=form.password_confirmation){
        ElNotification({
            title: 'Error',
            message: 'password was wrong',
            type: 'error',
        })
        return false;
    }

    return true;
}

const create=()=>{
    if(!validate())return;
    axios.post('/api/auth/create',form)
    .then((res)=>{
        ElNotification({
            title: 'Success',
            message: 'created',
            type: 'success',
        })
        emit('reLoad');
        isVisible.value=false;
    })
    .catch((error)=>{
        console.log('error '+error);
        ElNotification({
            title: 'Error',
            message: 'not created',
            type: 'error',
        });
    });
}
const open=()=>{
    isVisible.value=true;
}
defineExpose({
    open,
})

</script>
<template>
    <el-dialog v-model="isVisible" title="user add">
        <el-form :model="form">
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
            <el-form-item label="password" :label-width="140" >
                <el-input v-model="form.password" autocomplete="new-password" type="password"/>
            </el-form-item>
            <el-form-item label="re:password" :label-width="140" >
                <el-input v-model="form.password_confirmation" autocomplete="off" type="password"/>
            </el-form-item>
        </el-form>
        <div align="right">
            <el-button @click="create" type="primary">create</el-button>
        </div>
    </el-dialog> 
</template>