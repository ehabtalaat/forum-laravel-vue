<template>
  <div class="ele">

  <div class="dropdown">

    <i class="fas fa-bell dropdown-toggle" id="drop1" style="color:red;" data-toggle="dropdown"  v-if="unreadcount" aria-haspopup="true" aria-expanded="false"> </i>
    <i class="fas fa-bell dropdown-toggle" id="drop1" v-else style="color:red;opacity:.6;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </i>
     <span class="badge badge-primary">{{unreadcount}}</span>
 
    <div class="dropdown-menu menu">
      <div v-for="item in unread" :key="item.id">
       <a href="#" @click="readit(item)">
        <span  @click.prevent="clicked(item.path)">{{item.question}}</span>
        </a>
      </div>
    </div>
  </div>
</div>
</template>
<script>

export default {
  data() {
    return {
      read: null,
      unread: null,
      unreadcount: null,
    };
  },
  created() {
    if (User.isLogged()) {
      this.getnotificiation();
    }
     Echo.private('App.User.' + User.iduser())
    .notification((notification) => {
        this.unread.unshift(notification);
        this.unreadcount++;
    });
  },
  methods: {
    getnotificiation() {
      axios
        .post("/api/notifications")
        .then((res) => {
          this.read = res.data.read;
          this.unread = res.data.unread;
          this.unreadcount = res.data.unread.length;
        })
        .catch((error) => {return Exception.handle(error);

        });
    },
    readit(notification) {
      axios.post("/api/markAsRead/", { id: notification.id }).
       then((res) => {
        this.unread.splice(notification, 1);
        this.read.push(notification);
        this.unreadcount--;
      })
       .catch((error) => console.log(error.response));
    },
    clicked(itempath){
      window.location.href = `http://127.0.0.1:8000/${itempath}`;
    },
    
  },
};
</script>
<style scoped>
i {
  font-size: 1.2rem;
  cursor: pointer;
}
.dropdown .dropdown-menu{
  position: relative;
  z-index: 1000 !important;
}

</style>
