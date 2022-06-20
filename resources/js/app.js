/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require("./bootstrap");
window.Vue = require("vue");
import Vue from "vue";
import VueProgressBar from 'vue-progressbar'
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
})
// Swal alert ES6 Modules or TypeScript
import Swal from 'sweetalert2';
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
})
window.Toast = Toast
window.Fire = new Vue;
//Router
import VueRouter from "vue-router";
Vue.use(VueRouter);
//V-Form load
import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess,
} from "vform/src/components/bootstrap5";
// 'vform/src/components/bootstrap4'
// 'vform/src/components/tailwind'

Vue.component(Button.name, Button);
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);

//Vue Moment
Vue.use(require('vue-moment'));
Vue.filter('uppercase', function (value) {
    if (!value) return ''
    return value.charAt(0).toUpperCase() + value.slice(1)
})
//Routes
let Dashboard = require("./components/Dashboard.vue").default;
let Profile = require("./components/Profile.vue").default;
let User = require("./components/User.vue").default;

const routes = [
    { path: "/dashboard", component: Dashboard },
    { path: "/profile", component: Profile },
    { path: "/user", component: User },
];

const router = new VueRouter({
    mode: "history",
    routes,
});
//Default
Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

const app = new Vue({
    router,
    el: "#app",
});
