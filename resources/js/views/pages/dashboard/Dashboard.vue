<script setup>
import { reactive, onMounted, getCurrentInstance } from 'vue';
const app = getCurrentInstance()
const alert = app.appContext.config.globalProperties.$alert;

const page = reactive({
    blogs: [],
});

const getBlogs = () => {
    axios.get('/blogs-list').then((response)=>{
        if(response.data.success){
            page.blogs = response.data.data;
        }
    })
}

onMounted(() => {
    getBlogs();
})
</script>

<template>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Featured Posts</h1>
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6" v-for="(d, i) in page.blogs">
            <div class="landing-card mb-2 bg-white">
                <div v-html="d.content"></div>
            </div>
        </div>
    </div>
    <ViewContent ref="viewModal" />
</div>
</template>

<style scoped>
.landing-card
{
    position: relative;
    overflow: visible;
    width:100%;
    height: 70vh;
    padding: 30px 20px;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 12px;
    overflow: auto;
}
</style>