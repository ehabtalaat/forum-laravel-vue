<template>
  <div>
    <nav-bar></nav-bar>
    <router-view></router-view>
    <app-footer></app-footer>
  </div>
</template>
<script>
import NavBar from "./NavBar.vue";
import AppFooter from "./AppFooter.vue";
import Login from "./login/Login.vue";
export default {
  components: {
    NavBar,
    Login,
    AppFooter,
    
  },
};
</script>
<style lang="css" scoped>
</style>