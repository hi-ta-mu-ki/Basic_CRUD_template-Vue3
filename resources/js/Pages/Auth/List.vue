<script setup>
import { onMounted,ref } from 'vue';

const items = ref(null);
const itemsTotal = ref(0);
const page = ref(1);

const setPage = (val)=>{
    page.value = val;
    reLoadItems();
}

import axios from 'axios';

const reLoadItems = (filter='')=>{
    const params={page:page.value};
    if(filter!==''){
        params['filter']=filter;
    }
    axios.get('/api/auth/list',{
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
</script>

<template>
    <el-card>
    <el-table :data="items" style="width: 100%">
        <el-table-column prop="id" label="id" width="80" />
        <el-table-column prop="name" label="name" />    
        <el-table-column prop="email" label="e-mail" />    
    </el-table>
    </el-card>
    <el-pagination layout="prev, pager, next" :total="itemsTotal" @current-change="setPage"></el-pagination>
</template>