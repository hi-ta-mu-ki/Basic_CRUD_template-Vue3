<script setup>
import { reactive,onMounted,ref } from 'vue';
import { useRouter } from 'vue-router';

const items = ref(null);
const itemsTotal = ref(0);
const page = ref(1);
const setPage = (val)=>{
    page.value = val;
    reLoadItems();
}
const item = ref(0);
const form=reactive({
    b_masters_id:'',
});

import axios from 'axios';
const reLoadItems = (filter='')=>{
    const params={page:page.value};
    if(filter!==''){
        params['filter']=filter;
    } 
    axios.get('/api/b_master/list',{
            params:params
        })
        .then((res)=>{
            items.value = res.data.data;
            itemsTotal.value = res.data.total;
        });
}

onMounted(()=>{
    reLoadItems();
})

const router = useRouter();
const order = (val) =>{
    form.b_masters_id = val.id;
    axios.post('/api/transaction/create01',form)
        .then((res)=>{
            item.value = res.data;
            router.push(`/transaction/order/`+item.value.id);
        }).catch((error)=>{
            ElNotification({
            title: 'Error',
            message: 'Not created.',
            type: 'error',
        })
    });
}

import Edit from '@/Pages/B_master/Edit.vue'
const editRef = ref();

import Add from '@/Pages/B_master/Add.vue'
const addRef = ref();

import Delete from '@/Pages/B_master/Delete.vue'
const deleteRef = ref();

import Filter from '@/Pages/Common/Filter.vue'
</script>

<template>
    <Filter @reLoad="reLoadItems"></Filter>
    <el-table :data="items" style="width: 100%">
        <el-table-column prop="id" label="id" width="80" />
        <el-table-column prop="name" label="name" />
        <el-table-column prop="tel" label="tel" width="200" />
        <el-table-column fixed="right" label="operation" width="120">
            <template #default="scope">
                <el-button link type="primary" 
                    @click.prevent="order(items[scope.$index])">
                    order
                </el-button>
                <el-button link type="primary" 
                    @click.prevent="editRef.open(items[scope.$index])">
                    edit
                </el-button>
                <el-button link type="primary"
                    @click.prevent="deleteRef.open(items[scope.$index])">
                    delete
                </el-button>
            </template>
        </el-table-column>
    </el-table>
    <el-pagination layout="prev, pager, next" :total="itemsTotal" @current-change="setPage"></el-pagination>
    <el-button @click="addRef.open()">
        add
    </el-button>
    <Add ref="addRef" @reLoad="reLoadItems"></Add>
    <Edit ref="editRef" @reLoad="reLoadItems"></Edit>
    <Delete ref="deleteRef" @reLoad="reLoadItems"></Delete>
</template>
