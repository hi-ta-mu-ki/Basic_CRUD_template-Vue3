<script setup>

import axios from 'axios';
import {ElNotification,ElMessageBox } from 'element-plus';
import {defineEmits} from 'vue';

const emit = defineEmits(['reLoad']);

const open=(item)=>{
        ElMessageBox.confirm(
            item.namea+' will be deleted. Is it OK?',
            'Warning',
            {
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            type: 'warning',
            }
        )
        .then(() => {
            axios.delete('/api/transaction/delete02/'+item.id2)
            .then((res)=>{
                ElNotification({
                    type: 'success',
                    message: item.namea+' was deleted.',
                });
                emit('reLoad');
            }).catch((error)=>{
                ElNotification({
                    type: 'error',
                    message: item.namea+' was not deleted.',
                });
            })
        })
        .catch(() => {
            ElNotification({
                type: 'info',
                message: 'You have canceled.',
            });
        });
}

defineExpose({
    open,
})
</script>
<template></template>
