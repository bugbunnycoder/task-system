// resources/js/router/index.js

import Vue from 'vue';
import VueRouter from 'vue-router';
import FormComponent from '../components/TaskForm.vue';
import TaskListComponent from '../components/TaskList.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/create-task',
    component: FormComponent,
    props: route => ({ mode: 'create' })
  },
  {
    path: '/edit-task/:id',
    component: FormComponent,
    props: route => ({ mode: 'edit', taskId: parseInt(route.params.id) })
  },
  {
    path: '/task-list',
    component: TaskListComponent
  }
];

const router = new VueRouter({
  mode: 'history', // Use HTML5 history mode
  routes
});

export default router;
