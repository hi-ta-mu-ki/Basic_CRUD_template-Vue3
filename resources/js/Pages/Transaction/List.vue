<script setup>
import { onMounted,ref } from 'vue';
import { useRouter } from 'vue-router';

const items = ref(null);
const itemsTotal = ref(0);
const page = ref(1);

const setPage = (val)=>{
    page.value = val;
    reLoadItems();
}

const router = useRouter();
const order = (val) =>{
    router.push(`/transaction/order/`+val.id);
}

import axios from 'axios';
const reLoadItems = (filter='')=>{
    const params={page:page.value};
    if(filter!==''){
        params['filter']=filter;
    } 
    axios.get('/api/transaction/list',{
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

import Delete from '@/Pages/Transaction/DeleteOrder.vue'
const deleteRef = ref();

import Filter from '@/Pages/Common/Filter.vue'
</script>

<template>
    <Filter @reLoad="reLoadItems"></Filter>
    <el-table :data="items" style="width: 100%">
        <el-table-column prop="id" label="id" width="80" />
        <el-table-column prop="name" label="name" />
        <el-table-column prop="tel" label="tel" width="200" />
        <el-table-column prop="created_at" label="date" width="200" />
        <el-table-column fixed="right" label="operation" width="120">
            <template #default="scope">
                <el-button link type="primary" 
                    @click.prevent="order(items[scope.$index])">
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
    <Delete ref="deleteRef" @reLoad="reLoadItems"></Delete>
</template>
