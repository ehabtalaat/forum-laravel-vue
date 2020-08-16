<template>
    <div class="container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2 class="text-center">Ask Question
                </h2></div>
                <div class="card-body">
                    <form @submit.prevent="create()" class="col-md-12">
                         <div class="row">
                   <label class="col-md-12" >title:</label>
                  </div>
                        <div class="row">
                            <input
                                type="text"
                                placeholder="enter the title of the question...?"
                                v-model="form.title"
                                class="col-md-10"
                            />
                    
                        <div v-if="errors.title" class="alert alert-danger col-md-10">
                            {{errors.title}}
                        </div>
                        </div>
                         <div class="row">
                   <label class="col-md-12" >category:</label>
                  </div>
                        <div class="row">
                        <select
                            class="col-md-10"
                            style="height:2.5rem;"
                            v-model="form.category_id"
                        >
                            <option disabled="disabled" value="0"
                                >Select category:</option
                            >
                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                                >{{ category.name }}</option
                            >
                        </select>
                        <div v-if="errors.category" class="alert alert-danger col-md-10">
                            {{errors.category}}
                        </div>
                    </div>
                     <div class="row">
                   <label class="col-md-12" >body:</label>
                  </div>
                    <div class="row">
                     
                        <vue-simplemde
                            v-model="form.body"
                            ref="markdownEditor"
                            class="col-md-10"
                        />
                        <div v-if="errors.body" class="alert alert-danger col-md-10">
                            {{errors.body}}
                        </div>
                    </div>
                    <div class="row">
                        <input
                            type="submit"
                            value="create question"
                            class="btn btn-primary"
                        />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueSimplemde from "vue-simplemde";
export default {
    data() {
        return {
            form: {
                title: null,
                category_id: null,
                body: null
            },
            categories: {},
            errors:{
                title:"",
                body:"",
                category:""
            }
        };
    },
    components: {
        VueSimplemde
    },
    created() {
        axios
            .get("/api/category")
            .then(res => (this.categories = res.data.data))
            .catch(error => console.log(error));
    },
    methods: {
        create() {
            axios
                .post("api/question", this.form)
                .then(res => this.$router.push(res.data.path))
                .catch(error => {
             this.errors.title = error.response.data.errors.title[0];
             this.errors.body = error.response.data.errors.body[0];
             this.errors.category_id = error.response.data.errors.category_id[0];
                });
        }
    }
};
</script>
<style scoped>
@import "~simplemde/dist/simplemde.min.css";
.container{
    margin-top: 40px;
}
.card-header{
      background-color: #2dcf96;
      opacity: .7;
   }
   .card-header h2{
      color: white;
      font-weight: 18px;
      text-transform: capitalize;
   }

.row input[type=text] {
    color: #555;
    font-family: "poppins", sans-serif;
    margin-left: 0px;
    font-size: 18px;
    padding: 6px;
    margin-bottom: 20px;
}
.row select{
    margin-bottom: 20px;
    padding: 6px;
    color: #555;
}
label{
      font-size: 18px;
   }
    input[type=submit]{
      font-size: 15px;
      
   }
</style>
