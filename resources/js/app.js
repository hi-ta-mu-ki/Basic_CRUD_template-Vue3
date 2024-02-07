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
import fruitsList from './Pages/Fruits/List.vue'
import Login from './Pages/Auth/Login.vue'
import Logout from './Pages/Auth/Logout.vue'
import authList from './Pages/Auth/List.vue'
import authAdd from './Pages/Auth/Add.vue'
import authEdit from './Pages/Auth/Edit.vue'

const routes = [
    {
        path: '/layout',
        name: 'layout',
        component: Layout
    },
    {
        path: '/fruits',
        name: 'fruits.list',
        component: fruitsList
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
    {
        path: '/auth/add',
        name: 'auth.add',
        component: authAdd
    },
    {
        path: '/auth/edit',
        name: 'auth.edit',
        component: authEdit
    },
]

const router = vueRouter.createRouter({
    history: vueRouter.createWebHistory(),
    routes,
});

app.use(router);
authGuard(router);

app.mount('#app');
