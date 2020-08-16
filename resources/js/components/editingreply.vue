<template>
	<div>
		<vue-simplemde
           ref="markdownEditor"
            v-model="reply.body" />
            <div><span class="btn btn-primary btn-sm" @click="update">update</span>
            	<span class="btn btn-danger btn-sm" @click="cancel">cancel</span></div>
	</div>
</template>
<script>
import VueSimplemde from "vue-simplemde";
	export default{
  props:["reply"],
components:{
  VueSimplemde
		},
		methods:{
			update(){
				axios.patch(`http://127.0.0.1:8000/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,{body:this.reply.body}).
				then((res) => this.cancel(this.reply.body))
				.catch((error) => console.log(error.resonse));
			},
			cancel(reply){
				EventBus.$emit("cancelediting",reply);
			}
		}
	};
</script>
<style scoped>
	.btn-danger{
		margin-left: 20px;
	}
</style>