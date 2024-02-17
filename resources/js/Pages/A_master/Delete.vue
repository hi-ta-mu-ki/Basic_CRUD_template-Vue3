<script setup>

import axios from 'axios';
import {ElNotification,ElMessageBox } from 'element-plus';
import {defineEmits} from 'vue';

const emit = defineEmits(['reLoad']);

const open=(item)=>{
        ElMessageBox.confirm(
            item.name+' will be deleted. Is it OK?',
            'Warning',
            {
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            type: 'warning',
            }
        )
        .then(() => {
            axios.delete('/api/a_master/delete/'+item.id)
            .then((res)=>{
                ElNotification({
                    type: 'success',
                    message: item.name+' was deleted.',
                });
                emit('reLoad');
            }).catch((error)=>{
                ElNotification({
                    type: 'error',
                    message: item.name+' was not deleted.',
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
