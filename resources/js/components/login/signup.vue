<template>
	<div class="section">
		
		<img class="wave" src="img/wave.png" >
	<div class="container">
		<div class="img">
			<img src="img/mobile2.svg">
		</div>
		<div class="login-content">
			<form @submit.prevent="signup">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
				   		<div class="input-div one">   		
           		   	<div>	<input type="text"  placeholder="username" v-model="form.name"></div>
       <div>  <i class="fas fa-user"></i></div>
           		</div>
           		<div class="alert alert-danger" v-if="errors.name">{{errors.name[0]}}</div>
           		<div class="input-div one">   		
           		   	<div>	<input type="text"  placeholder="email" v-model="form.email"></div>
       <div>  <i class="fas fa-user"></i></div>
           		</div>
           		<div class="alert alert-danger" v-if="errors.email">{{errors.email[0]}}</div>
           		<div class="input-div pass">
           		    	
           		    <div>	<input type="password"  placeholder="password" v-model="form.password"></div>
           		   <div> 	<i class="fas fa-lock"></i></div>
            	</div>
            	<div class="alert alert-danger" v-if="errors.password">{{errors.password[0]}}</div>
            	<a href="#">Forgot Password?</a>
            	<button type="submit" class="btn">Signup</button> 
            		<router-link to="login"><p>login...?</p></router-link>
            		<div class="alert alert-success" v-if="successMessage" style="height:50px; width:330px;font-size:18px;">{{successMessage}}</div>
            </form>
        </div>
    </div>
	</div>
</template>
<script>
	export default{
  data(){
  	return{
  		form:{
  			name:null,
  		email:null,
  		password:null
  	},
  	errors:{},
  	successMessage:""
  	}
  },
   created(){
  	if(User.isLogged()){
  		this.$router.push({name:"forum"});
  	}
  },
  methods:{
  	signup(){
  	axios.post('api/auth/register',this.form)
  	.then((res)=> {
  		this.successMessage = res.data.message;
  		this.$router.push({name:'login'});
  	})
  	.catch((error) => this.errors = error.response.data.errors)
  }
  }
	};
</script>
<style lang="css" scoped>
	*{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
}
.section{
	display: block;
}
body{
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}
.wave{
	position: relative;
	height: 100vh;
	bottom: 0px;
	left: 0px;
	z-index: -1;
}
.img{
	float:left;
	position: absolute;
	left: 10%;
	transform: translateX(-10%);
	top: 50%;
	transform: translateY(-50%);

}
.login-content{
	position: absolute;
	left: 60%;
	transform: translateX(-60%);
	top: 50%;
	transform: translateY(-50%);
		display: block;
  margin-left: auto;
  margin-right: auto;
	}
.img img{
	width: 500px;
}

form{
	width: 360px;

}

.login-content img{
    height: 100px;
    text-align: center;
   display: block;
    margin-bottom: 35px;
    display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
.login-content h2{
	 text-align: center;
	color: #333;
	text-transform: uppercase;
	font-size: 3.4rem;
	font-weight: bold;
	margin-top: 15px;
}
.input-div {
	margin-top: 40px;
	position: relative;
	width: 340px;
	border-bottom: 3px solid #32be8f;
}
.input-div  input{
	position: relative;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	border: none;
	outline: none;
	background: none;
	font-size: 1.2rem;
	color: #555;
	font-family: 'poppins', sans-serif;
	padding-left: 40px;
	padding-top: 3px !important;
}
/*.input-div i{
	position: relative;
	top:-2px;
	left: 10px;
	font-size: 20px;
	color: #32be8f;
	
}*/
.input-div i{
	position: absolute;
	top:3px;
	left: 10px;
	font-size: 20px;
	color: #32be8f;
	
}
a{
	display: block;
	text-align: right;
	text-decoration: none;
	color: #999;
	font-size: 0.9rem;
	transition: .3s;
	margin-right: 20px;
	margin-top: 10px;
}
button.btn{
	display: block;
	width: 100%;
	height: 50px;
	border-radius: 25px;
	outline: none;
	border: none;
	width: 340px;
	margin-top: 20px;
	background-color: #32be8f !important;
	cursor: pointer;
	transition: .5s;
	color: #fff;
	font-size: 20px;
	font-weight: bold;

}
@media screen and (max-width: 1000px){
	form{
		width: 290px;
	}

	.login-content h2{
        font-size: 2.4rem;
        margin: 8px 0;
	}

	.img img{
		width: 400px;
	}
}

@media screen and (max-width: 890px){
	
	.img{
		display: none;
	}

	.wave{
		display: none;
	}

	.login-content{
	margin: 0px auto !important;
	text-align: center !important;
	  left: 50%;
	  top: 50%;
	  transform: translate(-50%,-50%);
	}
	.login-content img{
		margin:10px auto;
		display: block;
		text-align: center;
	}
}
</style>