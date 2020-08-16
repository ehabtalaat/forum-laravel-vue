<template>
  <div>
    <!--nav bar from boostrap 4-->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <router-link class="item" to="/"><span id="spa">SPA</span></router-link>
        <button class="navbar-toggler" type="button" @click="toggle()">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse toggle" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li>
              <app-notifications v-if="realshow"></app-notifications>
            </li>

            <router-link v-for="item in items" :key="item.title" class="item" :to="item.to">
              <p v-if="item.show">{{ item.title }}</p>
            </router-link>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
import AppNotifications from "./AppNotifications.vue";
export default {
  components: {
    AppNotifications,
  },
  data() {
    return {
      realshow: User.isLogged(),
      items: [
        { title: "forum", to: "/forum", show: true },
        {
          title: "categories",
          to: "/category",
          show: User.admin(),
        },
        { title: "Ask Question", to: "/ask", show: User.isLogged() },
        { title: "login", to: "/login", show: !User.isLogged() },
        { title: "logout", to: "/logout", show: User.isLogged() },
      ],
    };
  },
  methods: {
    toggle() {
      let x = document.querySelector(".toggle");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    },
  },
  created() {
    EventBus.$on("logout", () => {
      User.logout();
    });
  },
};
</script>
<style lang="css" scoped>
.navbar {
  background-color: #2dcf96;
  opacity: 0.6;
}
#spa {
  color: #fff;
  font-size: 23px;
  font-weight: bold;
  text-decoration: none;
}
link-router:hover{
  text-decoration: none;
}
#spa:hover{
  text-decoration: none;
}
span:hover{
  text-decoration: none;
}
.item {
  color: #fff;
  font-size: 21px;
  text-transform: capitalize;
}

.item p {
  padding-left: 8px;
  padding-top: 0.32rem;
  padding-bottom: 0.32rem;
  margin-right: 1rem;
  line-height: inherit;
  white-space: nowrap;
}
.item:hover {
  text-decoration: none;
}
li {
  margin-top: 0.7rem;
  margin-right: 1rem;
  position: relative;
  z-index: 1000 !important;
}
</style>
