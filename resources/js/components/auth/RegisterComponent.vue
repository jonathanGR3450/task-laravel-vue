<template>
    <div class="w-full sm:w-8/12 md:w-5/12 p-5 bg-white">
        <h1 class="text-3xl text-center font-bold py-4 text-gray-800">Register user</h1>

        <form method="post" v-on:submit.prevent="registerUser()">
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
            </ul>
            </p>

            <div class="d-block flex px-2 py-4">
                <input v-model="user.name" type="text" class="text-xl p-2 mr-2 w-full border-b-2 border-green-500"
                    placeholder="user name">
            </div>
            <div class="d-block flex px-2 py-4">
                <input v-model="user.email" type="email" class="text-xl p-2 mr-2 w-full border-b-2 border-green-500"
                    placeholder="user email">
            </div>
            <div class="d-block flex px-2 py-4">
                <input v-model="user.password" type="password" class="text-xl p-2 mr-2 w-full border-b-2 border-green-500"
                    placeholder="user password">
            </div>
            <div class="d-block flex px-2 py-4">
                <input v-model="user.password_confirmation" type="password"
                    class="text-xl p-2 mr-2 w-full border-b-2 border-green-500" placeholder="user password confirmation">
            </div>
            <div class="d-block flex">
                <input type="submit" value="Save" class="py-2 px-4 bg-green-500 w-full rounded-md text-white">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                'name': '',
                'email': '',
                'password': '',
                'password_confirmation': '',
            },
            errors: [],
        }
    },
    methods: {
        registerUser() {
            this.errors = [];
            let error = false;
            if (!this.user.name) {
                this.errors.push('Name is required!');
                error = true;
            }
            if (!this.user.email) {
                this.errors.push('Email is required!');
                error = true;
            }
            if (!this.user.password) {
                this.errors.push('Password is required!');
                error = true;
            }
            if (!this.user.password_confirmation) {
                this.errors.push('Password confirmation is required!');
                error = true;
            }
            if (error) {
                return;
            }

            axios.post('/api/v1/register', this.user)
                .then(response => {
                    console.log(response);
                    this.$router.push({ name: 'login' });
                })
                .catch(error => {
                    console.log(error.response);
                });
            this.task = '';
            this.$router.push({ name: 'login' });
        }
    }
}
</script>
