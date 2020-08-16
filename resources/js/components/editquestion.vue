<template>
    <div class="container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ask Question</div>
                <div class="card-body">
                    <form @submit.prevent="update()" class="col-md-10">
                        <div class="input-div one">
                            <input
                                type="text"
                                id="title"
                                placeholder="enter the title...?"
                                v-model="form.title"
                            />
                        </div>
                        <input type="hidden" id="slug"  v-model="form.slug">
                        <vue-simplemde
                            v-model="form.body"
                            ref="markdownEditor"
                        />
                        <div>
                        <input
                            type="submit"
                            value="update"
                        class="btn btn-primary"/> 
                        <span class="btn btn-danger" @click="cancel">cancel</span>
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
    props:["question"],
    data() {
        return {
            form: {
                title: null,
                body: null,
                slug:null
            },
        };
    },
    components: {
        VueSimplemde
    },
    created() {
        this.form = this.question;
        
    },
    methods: {
        cancel(){
            EventBus.$emit("cancelediting");
        },
        update() {
             axios.put(`http://127.0.0.1:8000/api/question/${this.question.slug}`,this.form)
                .then(res => console.log(res.data))
                .catch(error => console.log(error.response));
        },
    }
};
</script>
<style scoped>
@import "~simplemde/dist/simplemde.min.css";
.input-div {
    margin-top: 40px;
    position: relative;
    border-bottom: 3px solid #32be8f;
}
.input-div input[type="text"] {
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
    font-family: "poppins", sans-serif;
    padding-top: 3px !important;
}
</style>
