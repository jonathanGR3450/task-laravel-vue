import {createRouter, createWebHistory } from "vue-router";

import FormComponent from '../components/task/FormComponent.vue';
import ListComponent from '../components/task/ListComponent.vue';
import EditComponent from '../components/task/EditComponent.vue';

const routes = [
    {
        path: '/',
        name: 'tasks',
        component: ListComponent
    },
    {
        path: '/form',
        name: "form",
        component: FormComponent
    },
    {
        path: '/edit/:id',
        name: "edit",
        component: EditComponent
    },
];


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;