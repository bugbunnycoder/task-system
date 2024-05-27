<!-- EditForm.vue -->
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 my-5">
                <router-link to="/create-task" class="btn btn-primary mb-3">Create Task</router-link>
                <div class="card">
                    <div class="card-header">Task List</div>
                    <div class="card-body">
                        <div v-if="tasks.length === 0" class="alert alert-info" role="alert">
                            No tasks found.
                        </div>
                        <div v-else>
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(task, index) in tasks" :key="task.id">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ task.title }}</td>
                                <td>{{ task.description }}</td>
                                <td>{{ task.deadline }}</td>
                                <td>
                                    <router-link :to="{ name: 'edit-task', params: { id: task.id }}" class="btn btn-sm btn-primary">Edit</router-link>
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
export default {
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      editedTask: { ...this.task }
    };
  },
  methods: {
    submitForm() {
      // Emit an event to parent component with updated task data
      this.$emit('update', this.editedTask);
    }
  }
};
</script>
