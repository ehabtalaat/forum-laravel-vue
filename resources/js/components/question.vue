<template>
  <div>
    <div class="card">
      <div class="card-body">
        <h3>
          <router-link :to="question.path" class="inc">
            {{
            question.title
            }}
          </router-link>
        </h3>
        <h6>
          <span>posed by</span>
         <span class="user"> {{ question.user }}</span>
          <span>at {{ question.created_at }}</span>
        </h6>
        <div class="body">{{ question.body }}</div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["question"],
};
</script>
<style scoped>
h6 span {
  color: rgb(155, 152, 152);
  font-size: small;
}
h3 .inc {
  color: #2dcf96;
  opacity: 0.7;
  font-size: 1.7rem;
  font-weight: 6rem;
}
h3 .inc:hover {
  color: #2dcf96;
  opacity: 0.8;
  text-decoration: none;
}
.body{
 color:#333;
 line-height: 1.5;
 font-size: 1rem
}
.user{
  color: #222;
  font-size: 19px;
}
</style>
