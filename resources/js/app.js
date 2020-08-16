/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("AppHome", require("./components/AppHome.vue").default);
import router from "./Router/router.js";
import User from "./Helpers/User.js";
import Exception from "./Helpers/Exception.js";
window.User = User;
window.Exception =Exception;
window.EventBus = new Vue();
const app = new Vue({
    el: "#app",
    router
});