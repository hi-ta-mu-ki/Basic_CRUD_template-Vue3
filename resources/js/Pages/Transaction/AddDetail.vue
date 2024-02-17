<script setup>
import {reactive,ref,defineEmits} from 'vue'
import axios from 'axios';
import {ElNotification} from 'element-plus'
import { useRoute } from 'vue-router';

const items = ref(null);
const isVisible=ref(false);
const route = useRoute();
const form=reactive({
    o1_transactions_id:route.params.id,
    a_masters_id:'',
    quantity:0,
});
const emit = defineEmits(['reLoad']);

const create=()=>{
    axios.post('/api/transaction/create02',form)
        .then((res)=>{
        ElNotification({
            title: 'Success',
            message: 'Created.',
            type: 'success',
        })
        emit('reLoad');
        isVisible.value=false;
        }).catch((error)=>{
            ElNotification({
            title: 'Error',
            message: 'Not created.',
            type: 'error',
        })
    });
}

const open=()=>{
    axios.get('/api/a_master/list')
        .then((res)=>{
            items.value = res.data.data;
        });
    isVisible.value=true;
}
defineExpose({
    open,
})
</script>

<template>
    <el-dialog v-model="isVisible" title="Order Detail Add">
        <el-form :model="form">
            <el-form-item label="name" :label-width="140">
                <el-select
                    v-model="form.a_masters_id"
                    class="m-2"
                    placeholder="Select"
                    style="width: 240px"
                >
                    <el-option
                        v-for="item in items"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id"
                    />
                </el-select>
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
                <el-button @click="create" >create</el-button>
                <el-button @click="isVisible = false">cancel</el-button>
            </span>
        </template>
    </el-dialog> 
</template>