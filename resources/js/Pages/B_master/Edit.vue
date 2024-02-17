<script setup>
import {reactive,ref,defineEmits} from 'vue'
import axios from 'axios';
import {ElNotification} from 'element-plus'

const emit = defineEmits(['reLoad']);
const isVisible=ref(false);
const form=reactive({
    id:null,
    name:'',
    price:null,
});
const update=()=>{
    axios.put('/api/b_master/update/'+form.id,form)
        .then((res)=>{
            ElNotification({
            title: 'Success',
            message: form.name+' was updated.',
            type: 'success',
            })
            emit('reLoad');
        }).catch((error)=>{
            ElNotification({
            title: 'Error',
            message: form.name+' was not updated.',
            type: 'error',
            })
        });
}

const open=(item)=>{
    form.id=item.id;
    form.name=item.name;
    form.tel=item.tel;
    isVisible.value=true;
}
defineExpose({
    open,
})
</script>

<template>
    <el-dialog v-model="isVisible" title="B_master Edit">
        <el-form :model="form">
            <el-form-item label="id" :label-width="140">
                {{ form.id }}
            </el-form-item>
            <el-form-item label="name" :label-width="140">
                <el-input v-model="form.name" autocomplete="off" />
            </el-form-item>
            <el-form-item label="tel" :label-width="140">
                <el-input v-model="form.tel" autocomplete="off" />
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="update" >update</el-button>
                <el-button @click="isVisible = false">cancel</el-button>
            </span>
        </template>
    </el-dialog> 
</template>