<template>
    <el-container>
        <el-aside width="150px">
            <el-menu class="el-menu-vertical-demo" 
                router>
                <el-sub-menu index="1">
                    <template #title>
                        アカウント
                    </template>
                    <el-menu-item index="auth.logout" :route="{ name:'auth.logout' }">
                        ログアウト
                    </el-menu-item>
                    <el-menu-item index="auth.edit" :route="{ name:'auth.edit' }">
                        編集
                    </el-menu-item>
                    <el-menu-item index="auth.list" :route="{ name:'auth.list' }">
                        一覧
                    </el-menu-item>
                    <el-menu-item index="auth.add" :route="{ name:'auth.add' }">
                        新規登録
                    </el-menu-item>
                </el-sub-menu>
                <el-menu-item index="fruits.list" :route="{ name:'fruits.list' }">
                    フルーツ
                </el-menu-item>
            </el-menu>
        </el-aside>
        <el-main>
                <router-view></router-view>
        </el-main>
    </el-container>
</template>