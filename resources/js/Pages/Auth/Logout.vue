<script setup>
import { onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { useLoginState } from '../../assets/LoginState.js'

const router = useRouter();
const st = useLoginState();

const logout =()=>{
    axios.post('/logout').then((res)=>{
                        console.log('logout response:'+res.data.message);
                        st.setLogout();
                        st.abandonRole();
                        router.push({name:'auth.login'})
                    }).catch((err)=>{
                        console.log('logout error:'+err);
                    })
}

onMounted(()=>{
    logout();
})
</script>
<template></template>