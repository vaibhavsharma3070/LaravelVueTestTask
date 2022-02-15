require('./bootstrap');

// import Vue from 'vue'
// import VueRouter from 'vue-router';
// import App from './App.vue';

// Vue.use(VueRouter);

import { createApp } from 'vue';
import App from './App.vue';
import "vue-universal-modal/dist/index.css";
import VueUniversalModal from "vue-universal-modal";

let app = createApp({})

app.use(VueUniversalModal, {
    teleportTarget: '#modals'
})
createApp(App).mount('#app');
// const app = new Vue({
//     el: "#app",
//     component: { App }
// })
