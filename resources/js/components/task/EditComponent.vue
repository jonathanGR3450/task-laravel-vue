<template>
    <div class="w-full sm:w-8/12 md:w-5/12 p-5 bg-white">
        <h1 class="text-3xl text-center font-bold py-4 text-gray-800">Edit Task number {{ task.id }}</h1>

        <form method="post" v-on:submit.prevent="updateTask()">
            <div class="d-block flex px-2 py-4">
                <textarea
                v-model="task.todo"
                rows="3"
                name="todo"
                id="todo"
                class="text-xl p-2 mr-2 w-10/12 border-b-2 border-green-500"
                placeholder="new task"></textarea>
                <input type="submit" value="Update" class="bg-green-500 w-2/12 rounded-md text-white">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                task: [],
                taskId: this.$route.params.id
            }
        },
        methods: {
            updateTask() {
                let data = {
                    'todo': this.task.todo
                };
                axios.put(`/tasks/${this.taskId}`, data)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error.response);
                });
                this.task.todo = '';
                this.$router.push({name: 'tasks'});
            }
        },
        created() {
            axios.get(`/tasks/${this.taskId}/edit`)
            .then(response => {
                this.task = response.data
            })
            .catch();
        }
    }
</script>
