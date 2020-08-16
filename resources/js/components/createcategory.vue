<template>
	<div>
		<div class="container">
			<div class="col-md-8">
            <div>
			<div class="card">
				<div class="card-header">
					<h2 class="text-center">add category</h2>
				</div>
				<div class="card-body">
					<div class="col-md-12">
					<form @submit.prevent="submit" >
                  <div class="row">
                   <label class="col-md-12" >name:</label>
                  </div>
						<div class="row">
                    
							
						<input type="text" v-model="form.name" class="col-md-8" placeholder="enter the name of the category">
						<div v-if="successmessage" class="alert alert-success col-md-8">{{successmessage}}</div>
						<div v-if="errormessage" class="alert alert-danger col-md-8">{{errormessage}}</div>
					</div>
				
					<div class="row">
						<input type="submit" class="btn btn-primary  btn-sm" value="update" v-if="editslug">
						<input type="submit" class="btn btn-success  btn-sm" value="add category" v-else>
					</div>
					</form>
				</div>
			</div>
      </div>
      <div>
         
			<div class="card" id="cat">
			<div class="card-header">
				<h2 class="text-center">
					categories
				</h2>
			</div>
			<div class="card-body">
		   <ul class="list-group">
  		   <li  v-for="(category,index) in categories" 
  		   :key="category.id" class="list-group-item">
  		   <i class="fas fa-edit float-left mr-3" @click="edit(index)"></i>{{category.name}}
  		   <i class="fas fa-trash-alt float-right" @click="destroy(category.slug,index)"></i></li>
          </ul> 
			</div>
		
   </div>
			</div>
			</div>
      </div>
		</div>
	</div>
</template>
<script>
	export default{
   data(){
   	return{
   		form:{
   			name:null
   		},
   		successmessage:null,
   		errormessage:null,
   		categories:null,
   		editslug:null
   	}
   },
   created(){
   	if(!User.admin()){
   		this.$router.push('/forum'); 
   	}
   	axios.get('/api/category')
 	.then(res => this.categories = res.data.data)
 	.catch(error => console.log(error));
   },
   methods:{
   	submit(){
   		this.editslug ? this.update() : this.add();
   	},
   	add(){
   		axios.post('/api/category',this.form)
   		.then((res) => {
   			this.categories.unshift(res.data);
   			this.successmessage = res.data.message;
   		})
   		.catch((error) => 
   			{
   				this.errormessage = error.response.data.errors.name[0];
   			});
   	},
   	update(){
   		axios.patch(`/api/category/${this.editslug}`,this.form)
   		.then((res) => {
   			this.categories.unshift(res.data);
   		})
   		.catch((error) => 
   			{
   				this.errormessage = error.response.data.errors.name[0];
   			});
   	},
   	destroy(slug,index){
   		axios.delete(`http://127.0.0.1:8000/api/category/${slug}`)
   		.then((res) => this.categories.splice(index,1))
   		.catch((error) => console.log(error.response.data))
   	},
   	edit(index){
   		this.form.name=this.categories[index].name;
   		this.editslug = this.categories[index].slug;
   		this.categories.splice(index,1);
   		
   	}
   }
	};
</script>
<style scoped>
 .container{
   margin-top: 40px;
 }
 .card-header{
      background-color: #2dcf96;
      opacity: .7;
   }
   .card-header h2{
      color: white;
      font-weight: 23px;
      text-transform: capitalize;
   }
 #cat{
     margin-top: 40px;
     margin-bottom: 40px !important;
       }
	li i{
		cursor: pointer;
	}
   ul{
      width: 100%;
   }
   ul li{
      text-transform: capitalize;
      font-size: 20px;
      font-weight: 20px;
   }
   li i{
      color: #2dcf96;
      font-size: 16px;
   }
   label{
      font-size: 18px;
   }
   input[type=text]{
      padding: 7px;
      margin-bottom: 10px;
   }
   input[type=submit]{
      font-size: 15px;
      
   }
</style>