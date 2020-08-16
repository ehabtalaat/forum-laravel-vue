import User from "./User.js"
class Exception {
	handle(error){
		this.isExpired(error.response.data.message);
	}
	isExpired(error){
		if(error == "the token is invalid" || error == "the token is expired"){
			User.logout();
		}

		
	}
}
export default Exception = new Exception();