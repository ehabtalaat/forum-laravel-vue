<template>
  <div>
 <editquestion v-if="editing" :question="question"></editquestion>
 <div v-else>
    <showquestion :question="question"></showquestion>
  </div>
  <replies :question=question></replies>
  <newreply v-if="loggedin" :slugquestion=question.slug></newreply>
  </div>
</template>
<script>
import showquestion from "./showquestion.vue";
import editquestion from "./editquestion.vue";
import replies from "./replies.vue";
import newreply from "./newreply.vue"
export default {
  data() {
    return {
      question: {},
      editing:false,
      loggedin:User.isLogged()
    };
  },
  components: {
    showquestion,
    editquestion,
     replies,
     newreply
  },
  created() {
    this.listen();
    axios
      .get(`/api/question/${this.$route.params.slug}`)
      .then((res) => {
        this.question = res.data.data;
      })
      .catch((error) => console.log(error.response.data));
  },
  methods:{
    listen(){
      EventBus.$on('startediting',()=>{
        this.editing = true;
      });
      EventBus.$on('cancelediting',()=>{
        this.editing = false;
         
      });
       }
  }
};
</script>
