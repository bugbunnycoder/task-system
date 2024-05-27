<template>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12 my-5">
              <router-link to="/create-task" class="btn btn-primary mb-3">Create Task</router-link>
              <div class="card">
                  <div class="card-header">Task List</div>
                  <div class="card-body">
                      <div>
                          <table class="table">
                          <thead>
                              <tr>
                              <th scope="col">#</th>
                              <th scope="col">Title</th>
                              <th scope="col">Description</th>
                              <th scope="col">User</th>
                              <th scope="col">Deadline</th>
                              <th scope="col">Status</th>
                              <th scope="col">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(task, index) in tasks" :key="task.id">
                              <th scope="row">{{ ++index  }}</th>
                              <td>{{ task.title }}</td>
                              <td>{{ task.description }}</td>
                              <td>{{ task.employee.username }}</td>
                              <td>{{ task.deadline }}</td>
                              <td>
                                <!-- Select box for task status -->
                                <select @change="updateStatus(task.id, $event.target.value)">
                                  <option :value="1" :selected="task.status==1">Assigned</option>
                                  <option :value="2" :selected="task.status == 2">Completed</option>
                                  <option :value="3" :selected="task.status == 3">Deadline Approaching</option>
                                  <option :value="0" :selected="task.status == 0">Hold</option>
                                </select>
                              </td>

                              <td>
                                <router-link :to="`edit-task/${task.id}`" class="btn btn-sm btn-primary">Edit</router-link>
                                  <button @click="confirmDelete(task.id)" class="btn btn-sm btn-danger">Delete</button>
                              </td>
                              </tr>
                          </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>    

</template> 

<script>
import axios from 'axios';
import { createToastInterface } from 'vue-toastification';
import 'vue-toastification/dist/index.css';

export default {
  data() {
    return {
      tasks: [],
    };
  },
  mounted() {
    this.fetchTasks();
  },
  methods: {
    fetchTasks() {
      axios.get('/api/tasks',{headers: {'X-Api-Key': 'uihbbPpmF2Y25TTZXaA45mGIytTVHG'}
      })
        .then(response => {
          this.tasks = response.data;
        })
        .catch(error => {
          console.error('Error fetching tasks:', error);
        });
    },
    confirmDelete(taskId) {
      if (confirm('Are you sure you want to delete this task?')) {
        this.deleteTask(taskId);
      }
    },
    deleteTask(taskId) {
      axios.delete(`/api/tasks/${taskId}`,{headers: {'X-Api-Key': 'uihbbPpmF2Y25TTZXaA45mGIytTVHG'}})
        .then(response => {
          // Remove the deleted task from the tasks array
          this.successToast("Record has been deleted successfully");
          const tasksArray = Object.values(this.tasks);
          this.tasks = tasksArray.filter(task => task.id !== taskId);
          console.log('Task deleted successfully:', response.data);
          console.log('Remaining tasks:', this.tasks);
        })
        .catch(error => {
          // this.errorToast();
          console.error('Error deleting task:', error);
        });
    },
    updateStatus(taskId,newStatus) {
      axios.put(`/api/tasks/${taskId}/status`, { status: newStatus },{headers: {'X-Api-Key': 'uihbbPpmF2Y25TTZXaA45mGIytTVHG'}})
        .then(response => {
          this.successToast("Task status has been updated successfully");
          console.log('Task status updated successfully:', response.data);
        })
        .catch(error => {
          this.errorToast();
          console.error('Error updating task status:', error);
        });
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
    }
  }
};
</script>

<style>
/* Your component styles */
</style>
