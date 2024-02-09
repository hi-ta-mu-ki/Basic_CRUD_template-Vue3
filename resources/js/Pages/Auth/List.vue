<script setup>
import { onMounted,ref } from 'vue';
import USER_ROLE from "../../const"

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

import Edit from '@/Pages/Auth/Edit.vue'
const editRef = ref();

import Add from '@/Pages/Auth/Add.vue'
const addRef = ref();

import Delete from '@/Pages/Auth/Delete.vue'
const deleteRef = ref();

import Filter from '@/Pages/Common/Filter.vue'
</script>

<template>
    <Filter @reLoad="reLoadItems"></Filter>
    <el-table :data="items" style="width: 100%">
        <el-table-column prop="id" label="id" width="80" />
        <el-table-column prop="name" label="name" />    
        <el-table-column prop="email" label="e-mail" />    
        <el-table-column prop="role" label="role">    
            <template #default="scope">
                <div v-if="scope.row.role <= USER_ROLE.admin" >admin</div>
                <div v-else>user</div>
            </template>
        </el-table-column>
        <el-table-column fixed="right" label="operation" width="120">
            <template #default="scope">
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