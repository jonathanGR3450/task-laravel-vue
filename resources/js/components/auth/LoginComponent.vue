<template>
    <div class="w-full sm:w-8/12 md:w-5/12 p-5 bg-white">
        <h1 class="text-3xl text-center font-bold py-4 text-gray-800">Login user</h1>

        <form method="post" v-on:submit.prevent="login()">
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
            </ul>
            </p>
            <div class="d-block flex px-2 py-4">
                <input v-model="credentials.email" type="email" class="text-xl p-2 mr-2 w-full border-b-2 border-green-500"
                    placeholder="email">
            </div>
            <div class="d-block flex px-2 py-4">
                <input v-model="credentials.password" type="password"
                    class="text-xl p-2 mr-2 w-full border-b-2 border-green-500" placeholder="password">
            </div>
            <div class="d-block flex">

                <input type="submit" value="Save" class="px-2 py-4 bg-green-500 w-full rounded-md text-white">
            </div>
        </form>
    </div>
</template>

<script>
import Auth from '../../Auth.js';
export default {
    data() {
        return {
            credentials: {
                email: '',
                password: ''
            },
            errors: [],
        }
    },
    methods: {
        login() {
            let error = false;
            this.errors = [];
            if (!this.credentials.email) {
                this.errors.push('Email is required!');
                error = true;
            }
            if (!this.credentials.password) {
                this.errors.push('password is required!');
                error = true;
            }
            if (error) {
                return;
            }
            axios.post('/api/v1/login', this.credentials)
                .then(response => {
                    let data = response.data;
                    Auth.login(data.access_token, data.user);
                    this.$store.commit('setAuthenticated', true);
                    this.$router.push({ name: 'tasks' });
                })
                .catch(error => {
                    console.log(error.response);
                });
        }
    }
}
</script>
