<template>
	<div class="container">
		<div class="card">
			<div class="card-header">
		<h2 class="text-center">new reply:</h2>
	</div>
	<div class="card-body">
		<div class="row">
		<vue-simplemde
           ref="markdownEditor"
            v-model="body"
            class="col-md-12"
            />
            </div>
          <div  class="row">
          	<span class="btn btn-success btn-sm " @click="submit">add reply</span>
          	<span class="btn btn-danger ml-4 btn-sm " @click="cancel">cancel</span>
          </div>
          
	</div>
</div></div>
</div>
</template>

<script>
import VueSimplemde from "vue-simplemde";
	export default{
		props:['slugquestion'],
		data(){
			return{
					body:null
				
			}
		},
	components:{
		VueSimplemde
	},
	methods:{
		submit(){
			axios.post(`http://127.0.0.1:8000/api/question/${this.slugquestion}/reply`,{body:this.body})
			.then((res)=> {
			
			EventBus.$emit("newreply",res.data.reply);
			this.body = '';
			window.scrollTo(0,0);
			console.log(res.data)})
			.catch((error)=> console.log(error.response));
		},
		cancel(){
			this.body = null;
			window.scrollTo(0,0);
		}
	}
	};
</script>
<style scoped>
.container{
	margin-bottom:  40px;
}
	h4{
		margin-: 20px;
	}
	.card-header{
      background-color: #2dcf96;
      opacity: .7;
   }
   .card-header h2{
      color: white;
      font-weight: 18px;
      text-transform: capitalize;
   }
	 input[type=submit]{
      font-size: 15px;
      
   }
</style>