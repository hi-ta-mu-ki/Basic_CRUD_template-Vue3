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
    axios.put('/api/transaction/update/'+form.id,form)
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
    form.id=item.id2;
    form.namea=item.namea;
    form.quantity=item.quantity;
    isVisible.value=true;
}
defineExpose({
    open,
})
</script>

<template>
    <el-dialog v-model="isVisible" title="Transaction Edit">
        <el-form :model="form">
            <el-form-item label="id" :label-width="140">
                {{ form.id }}
            </el-form-item>
            <el-form-item label="name" :label-width="140">
                {{ form.namea }}
            </el-form-item>
            <el-form-item label="quantity" :label-width="140">
                <el-input-number
                    v-model="form.quantity"
                    :min="0"
                    controls-position="right"
                    />
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