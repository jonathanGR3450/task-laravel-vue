<template>
    <div class="">
        <nav class="flex p-4">
            <div v-if="isAuthenticated">
                <router-link to="/" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                    Tasks list
                </router-link>
                <router-link to="/form" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                    Add task
                </router-link>
                <router-link to="#" @click="logout()" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                    logout
                </router-link>
            </div>
            <div v-else>
                <router-link to="/login" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                    Login
                </router-link>
                <router-link to="/register" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                    Register
                </router-link>
            </div>


        </nav>
    </div>
</template>

<script>
import Auth from '../../Auth.js';
import axios from 'axios';
export default {
    computed: {
        isAuthenticated() {
            return this.$store.state.isAuthenticated;
        },
    },
    mounted() {
    },
    methods: {
        logout() {
            axios.post('/api/v1/logout')
                .then(response => {
                    console.log(response);
                    Auth.logout(); //reset local storage
                    // window.location.reload();
                    this.$store.commit('setAuthenticated', false);
                    this.$router.push({ name: 'login' })
                })
        }
    }
}
</script>
