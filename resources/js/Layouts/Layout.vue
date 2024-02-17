<script setup>
import {useLoginState} from '../assets/LoginState.js'
const st = useLoginState();
</script>
<template>
    <el-container>
        <el-aside width="150px">
            <el-menu class="el-menu-vertical-demo" 
                router>
                <el-menu-item index="auth.logout" :route="{ name:'auth.logout' }">
                    Logout
                </el-menu-item>
                <span v-if="st.role<=5 && st.role != null">
                    <el-menu-item index="auth.list" :route="{ name:'auth.list' }">
                        User
                    </el-menu-item>
                    <el-menu-item index="a_master.list" :route="{ name:'a_master.list' }">
                        A_master
                    </el-menu-item>
                </span>
                <span v-if="st.role==10 && st.role != null">
                    <el-menu-item index="b_master.list" :route="{ name:'b_master.list' }">
                        B_master
                    </el-menu-item>
                    <el-menu-item index="transaction.list" :route="{ name:'transaction.list' }">
                        Transaction
                    </el-menu-item>
                </span>
            </el-menu>
        </el-aside>
        <el-main>
                <router-view></router-view>
        </el-main>
    </el-container>
</template>