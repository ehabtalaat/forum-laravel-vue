<template>
	<div class="card">
		<div class="card-body">
			<editingreply v-if="editing" :reply=reply></editingreply>
			<div v-else>
			<p class="body">{{reply.body}}</p><like class="float-right" :reply=reply></like>
			<h4><span>answered by</span><span class="user">{{reply.user}} </span><span>at {{reply.created_at}}</span>
			<div  v-if="own" class="float-right">
				<i class="fas fa-edit " @click="edit"></i>
				<i class="fas fa-trash-alt " @click="destroy"></i>
			</div></h4>
		</div>
		</div>
	</div>
</template>
<script>
import like from "./like.vue";
import editingreply from "./editingreply";
	export default{
  props:["reply","index"],
  components:{
  	editingreply,
  	like
  },
  data(){
  	return{
  		own: null,
  		editing:false,
  		beforeedit:null
  	}
  },
  created(){
  	this.listen();
  },
  methods:{
  	destroy(){
  		EventBus.$emit("deletereply",this.index);
  	},
  	edit(){
  		this.editing = true; 
  		this.beforeedit = this.reply.body;
  	},
  	listen(){
  		EventBus.$on("cancelediting",(reply)=>{
  		this.editing = false;
  		if(reply !== this.reply.body){
  		this.reply.body = this.beforeedit;
  		this.beforeedit = "";
  	}
  		});
  	}
  },
   mounted(){
    setTimeout(() => {
     this.own = User.uid(this.reply.user_id)
      }, 800);
        },
	};
</script>
<style scoped>
  .card{
  	margin-top:1.5rem;
    margin-bottom: 20px;
  }
	h4 span{
		font-size: small;
		color: #999;
	}
	h4{
		font-size: 1rem;
		color: #555;
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
	
	.fas{
		cursor: pointer;
	}
	.fa-edit{
		margin-right: 15px !important;
	}
	.fa-trash-alt{
		margin-right: 10px !important
	}
</style>