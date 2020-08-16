<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4"><app-sidebar></app-sidebar></div>
      <div class="col-md-8">
        <question 
        v-for="question in questions" 
        :key="question.title" 
        :question=question></question>
      </div>
      
    </div>
  </div>
</template>
<script>
import question from "./question.vue";
import AppSidebar from "./AppSidebar.vue"

export default {
  data() {
    return {
      questions: {},
      
    };
  },
  components: {
    question,
    AppSidebar,
   
  },
  created() {
    axios
      .get("api/question")
      .then((res) => {
        this.questions = res.data.data;
        this.meta = res.data.meta;
      })
      .catch((error) => console.log(error.response.data));
  },
};
</script>
<style scoped>
  .container{
    margin-top: 30px;
  }
</style>