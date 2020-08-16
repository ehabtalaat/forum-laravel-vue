import Token from "./Token.js";
import AppStorage from "./AppStorage.js";
class User {
    login(data) {
        axios
            .post("/api/auth/login", data)
            .then(res => {
                this.responseAfterToken(res);
                //console.log(res.data);
                //	Token.payload(res.data.access_token);
            })
            .catch(error => console.log(error.rsponse.data));
    }
    responseAfterToken(res) {
        const token = res.data.access_token;
        const user = res.data.user;
        const id = res.data.id;
        console.log(token);
        if (Token.isValid(token)) {
            AppStorage.store(token, user, id);
            window.location = "/forum";
        }else{
            AppStorage.clear();
             window.location = "/forum";
        }
    }
    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : this.logout();
        }
         return false
    }
    isLogged() {
        return this.hasToken();
    }
    logout() {
        AppStorage.clear();
        window.location = "/forum";
    }
    username() {
        if (this.isLogged()) {
            return AppStorage.getUser();
        }
    }
    iduser(){
    return AppStorage.getid()
    }
    uid(userid) {
        if (this.isLogged()) {
          return this.iduser() == userid;
        }
    }
    admin(){
      return this.iduser() == 23;
    }
}
export default User = new User();
