<template>
    <div class="w-full sm:w-8/12 md:w-5/12 p-5 bg-white">
        <div v-for="task in taskList.data" :key="task.id"
            class="flex justify-content-center p-2 border-b-2 border-gray-300 my-2">
            <input type="checkbox" @click="toggledTask(task.id)" name="completed" id="completed" v-model="task.completed">
            <p class="mx-2 mt-1 text-gray-900">{{ task.todo }}</p>
            <div class="ml-auto flex">
                <router-link :to="'/edit/' + task.id">
                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </router-link>
                <form v-on:submit.prevent="deleteTask(task.id)">
                    <button type="submit">
                        <svg class="h-6 w-6 text-red-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="4" y1="7" x2="20" y2="7" />
                            <line x1="10" y1="11" x2="10" y2="17" />
                            <line x1="14" y1="11" x2="14" y2="17" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <div class="text-center">
            <TailwindPagination
                :data="taskList"
                @pagination-change-page="getTasks"
            />
        </div>
    </div>
</template>

<script setup>
import { TailwindPagination } from 'laravel-vue-pagination';
</script>

<script>
export default {
    data() {
        return {
            taskList: []
        };
    },
    methods: {
        getTasks(page = 1) {
            axios.get(`/tasks?page=${page}`)
                .then(response => {
                    this.taskList = response.data
                })
                .catch(error => {
                    console.log(error.response);
                })
        },
        deleteTask(id) {
            axios.delete(`/tasks/${id}`)
                .then(response => {
                    this.getTasks();
                })
        },
        toggledTask(id) {
            axios.post(`tasks/${id}/toggled`)
                .then(response => {
                    console.log(response);
                });
        }
    },
    created() {
        this.getTasks()
    },
}
</script>
