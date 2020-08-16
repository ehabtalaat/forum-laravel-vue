<template>
	<div>
		<div class="card">
			<div class="card-header">
				<h2 class="text-center">
					categories
				</h2>
			</div>
			<div class="card-body">
		   <ul class="list-group">
  		   <li  v-for="category in categories" :key="category.id" class="list-group-item">{{category.name}}</li>
          </ul> 
			</div>
		</div>
	</div>
</template>
<script>
export default{
	data(){
		return{
			categories:{}
		}
	},
 created(){
 	axios.get('/api/category')
 	.then(res => this.categories = res.data.data)
 	.catch(error => console.log(error));
 }
};	
</script>
<style scoped>
	.card-header{
		background-color: #2dcf96;
		opacity: .8;
	}
	.card-header h2{
		color: white;
		font-weight: 30px;
		text-transform: capitalize;
	}
	ul{
		width: 100%;
	}
	ul li{
		text-transform: capitalize;
		font-size: 20px;
		font-weight: 20px;
	}
</style>