<template>
  <h1>Home Page you can add task here</h1>
  <form @submit.prevent="taskForm">
    <div class="mb-4">
      <label class="block">Task</label>
      <input class="w-full p-2 border rounded" v-model="task.name" />
    </div>
    <div class="mb-4">
      <label class="block">Due Date</label>
      <input class="w-full p-2 border rounded" v-model="task.due_date" type="date" />
    </div>
    <div class="mb-4">
      <label class="block">Assigned To</label>
      <input class="w-full p-2 border rounded" v-model="task.assigned" type="text" />
    </div>
    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Save</button>
  </form>
  <div class="card-body w-100">
        <div class="table-responsive">
            <table class="table table-bordered w-100"> 
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Due Date</th>
                        <th>Assigned To</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="tasks && tasks.length > 0" v-for="(task, index) in tasks" :key="index">
                        <td>{{ task.id }}</td>
                        <td>{{ task.name }}</td>
                        <td>{{ task.date }}</td>
                        <td>{{ task.assigned_to }}</td>
                        <td>
                            <button @click="update(task)"></button>
                            <button @click="confirmDelete(task.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      task: {
        name: "",
        due_date: "",
        assigned: "",
      },
      errorMessage: "",
      tasks: [],
    };
  },
  methods: {
    async taskForm() {
      try {
        let response = await axios.post("http://127.0.0.1:8000/api/store", this.task);
        console.log("Task Added Successfully:", response.data);
        alert("Task Added Successfully");
        this.list();
      } catch (error) {
        this.errorMessage = error.response?.data?.message || "Registration failed";
      }
    },
    async list() {
      try {
        await axios.get("http://127.0.0.1:8000/api/fetch").then(({ data }) => {
          this.tasks = data;
        });
      } catch (error) {
        this.errorMessage = error.response?.data?.message || "Failed";
      }
    },
    confirmDelete(id) {
        this.delete(id);
    },
    delete(id) {
        axios.post("http://127.0.0.1:8000/api/delete", {'id':id }).then((response) => {
            this.list();
        }).catch((error) => { 
            return "Not Working";
        });
    },
  },
  created() {
    this.list();
  },
};
</script>
