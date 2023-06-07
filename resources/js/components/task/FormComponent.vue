<template>
    <div class="w-full sm:w-8/12 md:w-5/12 p-5 bg-white">
        <h1 class="text-3xl text-center font-bold py-4 text-gray-800">Create Tasks</h1>

        <form method="post" v-on:submit.prevent="saveTask()">
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in errors" :key="error">{{ error }}</li>
                </ul>
            </p>
            <div class="d-block flex px-2 py-4">
                <input v-model="task" type="text" name="todo" id="todo"
                    class="text-xl p-2 mr-2 w-10/12 border-b-2 border-green-500" placeholder="new task">
                <input type="submit" value="Save" class="bg-green-500 w-2/12 rounded-md text-white">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            task: '',
            errors: [],
        }
    },
    methods: {
        saveTask() {
            this.errors = [];
            if (!this.task) {
                this.errors.push('Task is required!');
                return;
            }
            let data = {
                'todo': this.task
            };
            axios.post('/api/v1/tasks', data)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error.response);
                });
            this.task = '';
            this.$router.push({ name: 'tasks' });
        }
    }
}
</script>
