<template>
	<div>
       <span v-if="liked">
       	<i class="fas fa-heart" style="color:red;" id="fas" @click="likeid"></i>
       </span>
       <span v-else>
		<i class="fas fa-heart" style="color:#e5a5a5;" id="fas" @click="likeid">
			
		</i></span>
		<span class="ml-2" >{{count}}</span>
	</div>
</template>
<script>
	export default{
   props:["reply"],
     data(){
     	return{
     		liked:this.reply.liked,
     		count:this.reply.like_count
     	}
     },
     created(){
        Echo.channel('likeChannel')
    .listen('LikeEvent', (e) => {
        if(this.reply.id == e.id){
            e.type == 1 ? this.count ++ : this.count --;
        }
    });
     },
     methods:{
     	likeid(){
     		if(User.isLogged()){
     			this.liked ? this.decrem() : this.increm();
     			this.liked = !this.liked;
     		}
     	},
     	increm(){
     		axios.post(`http://127.0.0.1:8000/api/like/${this.reply.id}`)
     		.then(res =>{
     			this.count++;
     		});
     		
          
     	},
     	decrem(){
     	    axios.delete(`http://127.0.0.1:8000/api/like/${this.reply.id}`)
     		.then(res =>{
     			this.count--;
     		});
     	},
     	
     }
	};
</script>
<style scoped>
.fas{
	font-size: 1.2rem;
	cursor: pointer;
}
	
</style>