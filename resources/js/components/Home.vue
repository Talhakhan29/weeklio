<template>

    <h1>Home Page you can add task here</h1>
    <form @submit.prevent="taskForm">
        <div class="mb-4">
            <label class="block">Task</label>
            <input class="w-full p-2 border rounded" v-model="task.name"/>
        </div>
        <div class="mb-4">
            <label class="block">Due Date</label>
            <input class="w-full p-2 border rounded" v-model="task.due_date" type="date"/>
        </div>
        <div class="mb-4">
            <label class="block">Assigned To</label>
            <input class="w-full p-2 border rounded" v-model="task.assigned" type="text"/>
        </div>
    </form>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            task:{
                name:"",
                due_date:"",
                assigned:"",
            },
            errorMessage:"",
        };
    },
    methods:{
        async taskForm() {
      try {
        let response = await axios.post("http://127.0.0.1:8000/api/task", this.task);
        console.log("Task Added Succesfully:", response.data);
        alert("Registration successful! You can now log in.");
      } catch (error) {
        this.errorMessage = error.response?.data?.message || "Registration failed";
      }
    },
  },
};

</script>