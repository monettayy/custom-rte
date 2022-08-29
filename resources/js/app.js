require('./bootstrap');

import { createApp } from 'vue';

import pages from './pages';
import alert from './alert'

import Sidebar from './components/Sidebar.vue';

const app = createApp({
    components:pages
})
app.config.globalProperties.$alert = alert;
app.component('sidebar', Sidebar)
app.mount("#app");
