/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import routes from './routes/index'
import NavComponent from './components/shared/NavComponent.vue'


const app = createApp({});
app.use(routes);

app.component('nav-component', NavComponent);


app.mount('#app');
