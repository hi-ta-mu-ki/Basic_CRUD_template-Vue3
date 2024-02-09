import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import { createPinia } from 'pinia'
import { authGuard } from "./auth-guard";

const app = createApp(App);

app.use(ElementPlus);
app.use(createPinia());

import * as vueRouter from "vue-router";
import Layout from './Layouts/Layout.vue'
import A_masterList from './Pages/A_master/List.vue'
import B_masterList from './Pages/B_master/List.vue'
import Login from './Pages/Auth/Login.vue'
import Logout from './Pages/Auth/Logout.vue'
import authList from './Pages/Auth/List.vue'

const routes = [
    {
        path: '/layout',
        name: 'layout',
        component: Layout
    },
    {
        path: '/a_master',
        name: 'a_master.list',
        component: A_masterList
    },
    {
        path: '/b_master',
        name: 'b_master.list',
        component: B_masterList
    },
    {
        path: '/',
        name: 'auth.login',
        component: Login
    },
    {
        path: '/auth/logout',
        name: 'auth.logout',
        component: Logout
    },
    {
        path: '/auth/list',
        name: 'auth.list',
        component: authList
    },
]

const router = vueRouter.createRouter({
    history: vueRouter.createWebHistory(),
    routes,
});

app.use(router);
authGuard(router);

app.mount('#app');
