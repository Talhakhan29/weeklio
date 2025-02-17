<template>
  <div class="max-w-md mx-auto p-4 bg-white shadow-lg rounded">
    <h2 class="text-xl font-bold mb-4">Login</h2>

    <form @submit.prevent="loginForm">
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input v-model="login.email" type="email" class="w-full p-2 border rounded" required />
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input v-model="login.password" type="password" class="w-full p-2 border rounded" required />
      </div>
      <div class="mb-4">
        <p>If not registered go to <a href="/register"><b>registeration page</b></a></p>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
    </form>
    <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>
  </div>
  
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      login: {
        email: "",
        password: "",
      },
      errorMessage: "",
    };
  },
  methods: {
    async loginForm() {
      try {
          let response = await axios.post("http://127.0.0.1:8000/api/login", this.login);
          if (response.data.status) {
              console.log("Login successful:", response.data);
              localStorage.setItem("token", response.data.token);
              window.location.href = response.data.redirect;  
          } else {
              this.errorMessage = response.data.message || "Login failed";
         }
      } catch (error) {
          this.errorMessage = error.response?.data?.message || "Login failed";
      }
    },
  },
};
</script>

