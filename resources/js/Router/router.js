import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);
import Login from "../components/login/Login.vue";
import signup from "../components/login/signup.vue";
import logout from "../components/login/logout.vue";
import forum from "../components/forum.vue";
import read from "../components/read.vue";
import spa from "../components/spa.vue";
import createquestion from "../components/createquestion.vue";
import createcategory from "../components/createcategory.vue";
const routes = [
    { name: "login", path: "/login", component: Login },
    { name: "signup", path: "/register", component: signup },
    { name: "forum", path: "/forum", component: forum },
    { name: "logout", path: "/logout", component: logout },
    { name: "read", path: "/question/:slug", component: read },
     { name: "spa", path: "/", component: spa },
    { name: "create", path: "/ask", component: createquestion },
    { name: "createcategory", path: "/category", component: createcategory },
];
const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
});
export default router;
