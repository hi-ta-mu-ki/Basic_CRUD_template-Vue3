<script setup>
import {reactive,ref,defineEmits} from 'vue'
import axios from 'axios';
import {ElNotification} from 'element-plus'

const isVisible=ref(false);
const form=reactive({
    name:'',
    price:null,
});
const emit = defineEmits(['reLoad']);
const create=()=>{
    axios.post('/api/b_master/create',form)
        .then((res)=>{
        ElNotification({
            title: 'Success',
            message: form.name+'was created',
            type: 'success',
        })
        emit('reLoad');
        isVisible.value=false;
        }).catch((error)=>{
            ElNotification({
            title: 'Error',
            message: form.name+'was created',
            type: 'error',
        })
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
    <el-dialog v-model="isVisible" title="B_master Add">
        <el-form :model="form">
            <el-form-item label="name" :label-width="140">
                <el-input v-model="form.name" autocomplete="off" />
            </el-form-item>
            <el-form-item label="tel" :label-width="140">
                <el-input v-model="form.price" autocomplete="off" />
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="create" >create</el-button>
                <el-button @click="isVisible = false">cancel</el-button>
            </span>
        </template>
    </el-dialog> 
</template>