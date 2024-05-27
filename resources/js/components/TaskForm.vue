<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 my-5">
        <router-link to="/task-list" class="btn btn-primary mb-3">View Tasks</router-link>
        <div class="card">
          <div class="card-header" v-if="mode === 'create'">Create Task</div>
          <div class="card-header" v-else>Edit Task</div>
          <div class="card-body">
            <form @submit.prevent="submitForm">
              <div class="mb-3">
                <label for="employee" class="form-label">Employee</label>
                <select id="employee" class="form-control" v-model="formData.employee_id" required>
                  <option value="" disabled>Select an employee</option>
                  <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ employee.username }}</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" class="form-control" v-model="formData.title" required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" v-model="formData.description" required></textarea>
              </div>
              <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" id="deadline" class="form-control" v-model="formData.deadline" required>
              </div>
              <button type="submit" class="btn btn-primary">{{ mode === 'create' ? 'Create' : 'Update' }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>    
  </div>
</template>

<script>
import { createToastInterface } from 'vue-toastification';
import 'vue-toastification/dist/index.css';

export default {
  props: {
    mode: {
      type: String,
      required: true,
      validator: value => ['create', 'edit'].includes(value)
    },
    taskId: {
      type: Number,
      default: null
    }
  },
  data() {
    return {
      formData: {
        title: '',
        description: '',
        deadline: '',
        employee_id: null, // Change to employeeId
      },
      employees: []
    };
  },
  mounted() {
    if (this.mode === 'edit') {
      // Fetch task data for editing if in edit mode
      this.fetchTask();
    }
    this.fetchEmployees();
  },
  methods: {
    fetchTask() {
      // Fetch task data using taskId
      // For example, using axios or another HTTP client
      // Simulated data fetching
      const taskId = this.taskId;
      // Assuming there's an API endpoint /api/tasks/:id to fetch task data
      axios.get(`/api/tasks/${taskId}`,{headers: {'X-Api-Key': 'uihbbPpmF2Y25TTZXaA45mGIytTVHG'}})
        .then(response => {
          this.formData = response.data; // Assuming response.data contains task details
        })
        .catch(error => {
          console.error('Error fetching task:', error);
        });
    },
    submitForm() {
      if (this.mode === 'create') {
        // Logic to create a new task
        // For example, using axios or another HTTP client
        // Simulated creation
        axios.post('/api/tasks', this.formData, {headers: {'X-Api-Key': 'uihbbPpmF2Y25TTZXaA45mGIytTVHG'}})
          .then(response => {
            this.successToast('Task created successfully');
            console.log('Task created successfully:', response.data);
            // Navigate back to the task list after successful creation
            this.$router.push('/task-list');
          })
          .catch(error => {
            this.errorToast();
            console.error('Error creating task:', error);
          });
      } else if (this.mode === 'edit') {
        // Logic to update the task with taskId
        // For example, using axios or another HTTP client
        // Simulated update
        const taskId = this.taskId;
        axios.put(`/api/tasks/${taskId}`,this.formData,{headers: {'X-Api-Key': 'uihbbPpmF2Y25TTZXaA45mGIytTVHG'}})
          .then(response => {
            this.successToast('Task updated successfully');
            console.log('Task updated successfully:', response.data);
            // Navigate back to the task list after successful update
            this.$router.push('/task-list');
          })
          .catch(error => {
            this.errorToast();
            console.error('Error updating task:', error);
          });
      }
    },
    successToast(message) {
      const toast = createToastInterface();
      toast.success(message, {
        position: 'top-right',
        timeout: 3000, // Duration in milliseconds
        closeOnClick: true,
        pauseOnHover: true,
        draggable: true,
        draggablePercent: 0.6,
        showCloseButtonOnHover: false,
        hideProgressBar: false,
        closeButton: 'button',
        icon: true,
        rtl: false,
      });
    },
    errorToast() {
      const toast = createToastInterface();
      toast.error('Something went wrong', {
        position: 'top-right',
        timeout: 3000, // Duration in milliseconds
        closeOnClick: true,
        pauseOnHover: true,
        draggable: true,
        draggablePercent: 0.6,
        showCloseButtonOnHover: false,
        hideProgressBar: false,
        closeButton: 'button',
        icon: true,
        rtl: false,
      });
    },
    fetchEmployees() {
      // Fetch employees using Axios
      axios.get('/api/employees',{headers: {'X-Api-Key': 'uihbbPpmF2Y25TTZXaA45mGIytTVHG'}})
        .then(response => {
          this.employees = response.data;
        })
        .catch(error => {
          console.error('Error fetching employees:', error);
        });
    },
  }
};
</script>
