
import {createRouter, createWebHistory } from "vue-router";

import FormComponent from '../components/task/FormComponent.vue';
import ListComponent from '../components/task/ListComponent.vue';
import EditComponent from '../components/task/EditComponent.vue';
import RegisterComponent from '../components/auth/RegisterComponent.vue';
import LoginComponent from '../components/auth/LoginComponent.vue';

import Auth from '../Auth.js';

const routes = [
    {
        path: '/',
        name: 'tasks',
        component: ListComponent,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/form',
        name: "form",
        component: FormComponent,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/edit/:id',
        name: "edit",
        component: EditComponent,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/register',
        name: "register",
        component: RegisterComponent
    },
    {
        path: '/login',
        name: "login",
        component: LoginComponent
    },
];


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) ) {
        if (Auth.check()) {
            next();
            return;
        } else {
            router.push({name: 'login'});
        }
    } else {
        next();
    }
});

export default router;