// resources/js/app.js

require('./bootstrap');
window.Vue = require('vue').default;

import router from './router';

const app = new Vue({
    router,
}).$mount('#app');
