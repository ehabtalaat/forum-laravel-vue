<template>
	<div class="container">
		<h2>replies:</h2>
		<div v-if="question.replies && question.replies.length > 0">
		<reply v-for="(reply,index) in question.replies" :key="reply.id" :index=index  :reply=reply> </reply>
	</div>
	<div v-else> <h4>sorry no replies on the question yet</h4></div>
	</div>
</template>
<script>
import reply from "./reply.vue";
	export default{
   props:["question"],
   data(){
   	return{
   
   	}
   },
   components:{
   	reply
   },
   created(){
   	this.listen();
 },
   mounted(){
   	
   },
   methods:{
 listen(){
 	EventBus.$on('newreply',(reply)=>{
   this.question.replies.unshift(reply);
 	});
 	EventBus.$on('deletereply',(index) => {
 		//console.log(this.content[index].id);
 		axios.delete(`http://127.0.0.1:8000/api/question/${this.question.slug}/reply/${this.question.replies[index].id}`)
 		.then((res) =>{
 		this.question.replies.splice(index,1);
 		})
 	})
   Echo.private('App.User.' + User.iduser())
    .notification((notification) => {
        this.question.replies.unshift(notification.reply);
    });
    Echo.channel('deletereplyChannel')
    .listen('DeleteReplyEvent',(e) =>{
      for(let i = 0; i < this.question.replies.length; i++){
        if(this.question.replies[i].id == e.id){
          this.question.replies.splice(i,1);
        }
      }
    })
 }
   }
	};
</script>
<style scoped>
	.contanier {
		margin-top: 40px !important;
	}
  h2{
    margin-top: 20px;
    color: #2dcf96;
    opacity: .7;
  }
	h4{
		margin-top: 10px;
	}
</style>
