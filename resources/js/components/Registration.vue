<template>
  <div >
    <h2 >Register</h2>

    <form @submit.prevent="registerform">
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input v-model="register.name" type="text" class="w-full p-2 border rounded" required />
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input v-model="register.email" type="email" class="w-full p-2 border rounded" required />
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input v-model="register.password" type="password" class="w-full p-2 border rounded" required />
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Register</button>
    </form>
    <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      register: {
        name: "",
        email: "",
        password: "",
      },
      errorMessage: "",
    };
  },
  methods: {
    async registerform() {
      try {
        let response = await axios.post("http://127.0.0.1:8000/api/register", this.register);
        console.log("Registration successful:", response.data);
        alert("Registration successful! You can now log in.");
      } catch (error) {
        this.errorMessage = error.response?.data?.message || "Registration failed";
      }
    },
  },
};
</script>

