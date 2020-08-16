class AppStorage {
    storeToken(token) {
        localStorage.setItem("token", token);
    }
    storeUser(user) {
        localStorage.setItem("user", user);
    }
    storeid(id) {
        localStorage.setItem("id", id);
    }
    store(token, user, id) {
        this.storeToken(token);
        this.storeUser(user);
        this.storeid(id);
    }
    clear() {
        localStorage.removeItem("token");
        localStorage.removeItem("user");
        localStorage.removeItem("id");
    }
    getToken() {
        return localStorage.getItem("token");
    }
    getUser() {
        return localStorage.getItem("user");
    }
    getid() {
        return localStorage.getItem("id");
    }
}
export default AppStorage = new AppStorage();
