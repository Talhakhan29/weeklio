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
    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">
      {{ task.id ? "Update Task" : "Save Task" }}
    </button>
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
          <tr v-if="tasks.length > 0" v-for="(task, index) in tasks" :key="index">
            <td>{{ task.id }}</td>
            <td>{{ task.name }}</td>
            <td>{{ task.due_date }}</td>
            <td>{{ task.assigned }}</td>
            <td>
              <button @click="update(task)">Update</button>
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
        id: null,  
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
        if (this.task.id) {
          await axios.put(`http://127.0.0.1:8000/api/update/${this.task.id}`, this.task);
          alert("Task Updated Successfully");
        } else {
          await axios.post("http://127.0.0.1:8000/api/store", this.task);
          alert("Task Added Successfully");
        }
        this.resetForm();
        this.list();
      } catch (error) {
        this.errorMessage = error.response?.data?.message || "Operation failed";
      }
    },
    async list() {
      try {
        const { data } = await axios.get("http://127.0.0.1:8000/api/fetch");
        this.tasks = data;
      } catch (error) {
        this.errorMessage = error.response?.data?.message || "Failed to fetch tasks";
      }
    },
    update(task) {
      this.task = { ...task }; 
    },
    confirmDelete(id) {
      this.delete(id);
    },
    async delete(id) {
      try {
        await axios.post("http://127.0.0.1:8000/api/delete", { id });
        this.list();
      } catch (error) {
        this.errorMessage = "Task deletion failed";
      }
    },
    resetForm() {
      this.task = { id: null, name: "", due_date: "", assigned: "" };
    }
  },
  created() {
    this.list();
  },
};
</script>
