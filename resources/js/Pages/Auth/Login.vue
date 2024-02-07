<script setup>
import {ref} from 'vue'
import axios from 'axios'
import {ElNotification } from 'element-plus'
import {useLoginState} from '../../assets/LoginState.js'

const email = ref('');
const password = ref('');
const st = useLoginState();

const login = () =>{

    axios.get('/sanctum/csrf-cookie')
        .then((res)=>{
            axios.post('/login', {
                        email: email.value,
                        password: password.value,
                    }).then((res)=>{
                        console.log('login response:'+res.data.message);
                        console.log('login status:'+res.data.status);
                        if(res.data.status==200){
                            st.setLogin();
                            dialogVisible.value=false;
                        }else{
                            ElNotification({
                                title: 'Error',
                                message: 'ログイン失敗しました',
                                type: 'error',
                            })
                        }
                    }).catch((err)=>{
                        console.log('login error:'+err);
                    })
        })

};

const dialogVisible = ref(true)
</script>

<template>
    <el-dialog v-model="dialogVisible" title="Login"
        :close-on-click-modal="false" :show-close="false">
        <el-form-item label="email" :label-width="140">
            <el-input v-model="email" autocomplete="off" />
        </el-form-item>
        <el-form-item label="password" :label-width="140">
            <el-input v-model="password" autocomplete="off" type="password"/>
        </el-form-item>
        <div align="right">     
        <el-button @click="login" type="primary">Login</el-button>
        </div>
    </el-dialog>
</template>