<template>
    <div class="">
        <nav class="flex p-4">
            <router-link to="/"
            class="text-xl text-white mx-3 p-2"
            active-class="font-bold"
            exact>
                Home
            </router-link>
            <router-link
            to="/form"
            class="text-xl text-white mx-3 p-2"
            active-class="font-bold"
            exact>
                Add task
            </router-link>

        </nav>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
