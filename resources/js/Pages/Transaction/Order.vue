<script setup>
import { onMounted,ref } from 'vue';
import { useRoute } from 'vue-router';

const items = ref(null);
const itemsTotal = ref(0);
const page = ref(1);
const setPage = (val)=>{
    page.value = val;
    reLoadItems();
}
const item = ref(null);

const route = useRoute();
import axios from 'axios';
const reLoadItems = (filter='')=>{
    const params={page:page.value};
    if(filter!==''){
        params['filter']=filter;
    } 
    axios.get('/api/transaction/edit_order/'+route.params.id)
        .then((res)=>{
            items.value = res.data.data;
            itemsTotal.value = res.data.total;
        });
}
const getName = ()=>{
    axios.get('/api/transaction/add_order/'+route.params.id)
        .then((res)=>{
            item.value = res.data;
        });
}

onMounted(()=>{
    getName();
    reLoadItems();
})

import Edit from '@/Pages/Transaction/EditDetail.vue'
const editRef = ref();

import Add from '@/Pages/Transaction/AddDetail.vue'
const addRef = ref();

import Delete from '@/Pages/Transaction/DeleteDetail.vue'
const deleteRef = ref();

import Filter from '@/Pages/Common/Filter.vue'
</script>

<template>
    <div>Order</div>
    <div v-if="item!=null">client name:{{ item.nameb }}<br />tel:{{ item.tel }}</div>
    <Filter @reLoad="reLoadItems"></Filter>
    <el-table :data="items" style="width: 100%">
        <el-table-column prop="id2" label="id" width="80" />
        <el-table-column prop="namea" label="name" />
        <el-table-column prop="quantity" label="quantity" />
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
