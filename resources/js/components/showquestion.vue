<template>
    <div>
        <div class="card">
            <div class="container">
                <div class="card-body">
                    <h3>{{ question.title }}</h3>
                    <button class="btn btn-secondary float-right">
                        {{question.replies_count}} replies
                    </button>
                    <h6>
                        <span>posted by</span>
                     <span class="user">   {{ question.user }}</span>
                        <span>at {{ question.created_at }}</span>
                    </h6>

                    <p class="body">{{ question.body }}</p>
                    <div v-if="own">

                    <i class="fas fa-edit" @click="editing"></i>
                    <i class="fas fa-trash-alt ml-4" @click="destory"></i>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Token from "../Helpers/AppStorage.js";
export default {
    props: ["question"],
    data() {
        return {
         own: null,
        }
    },
     mounted(){
    setTimeout(() => {
     this.own = User.uid(this.question.user_id)
      }, 800);
        },
        created(){
            EventBus.$on("newreply",()=>{
                this.question.replies_count++;
            });
     Echo.private('App.User.' + User.iduser())
    .notification((notification) => {
        this.question.replies_count++;
    });

     EventBus.$on("deletereply",()=>{
     this.question.replies_count--;
            });
     Echo.channel('deletereplyChannel')
    .listen('DeleteReplyEvent',(e) =>{
    this.question.replies_count--;
    });
        },
    methods:{
        destory(){
            axios.delete(`/api/question/${this.question.slug}`)
            .then(res => this.$router.push('/forum'))
            .catch(error => console.log(error.response.data));
        },
        editing(){
            EventBus.$emit('startediting');
        },
        
    }
};
</script>
<style scoped>

.card{
    position: relative;
    z-index: 2;
}
h6 span {
    color: rgb(155, 152, 152);
    font-size: small;
}
h3 {
    color: #2dcf96;
  opacity: 0.7;
  font-size: 1.7rem;
  font-weight: 6rem;
    margin-top: 20px;
    margin-bottom: 20px;
}
.btn {
    border-radius: 0px !important;
    background-color: #2dcf96;
    border: none;
    opacity: .7;
    font-size: 18px;
}
.card-body i{
    cursor: pointer;
}
.card{
    margin-bottom: 30px;
}
.user{
  color: #222;
  font-size: 19px;
}
.body{
 color:#333;
 line-height: 1.5;
 font-size: 1rem
}
</style>
