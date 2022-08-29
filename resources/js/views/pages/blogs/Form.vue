<script setup>
import { ref, reactive, onMounted, defineProps, getCurrentInstance  } from 'vue';
import RichTextEditor from '../../../editor/RichTextEditor.vue';
import moment from "moment";

const app = getCurrentInstance()
const alert = app.appContext.config.globalProperties.$alert;

const props = defineProps({
    _blog: {
        type: Object,
        default: null
    }
});

const form = reactive({
    title: '',
    content: '',
});

const page = reactive({
    for_edit: false,
});

const rteContent = ref(null)

const saveBlog = () => {
    let content = rteContent.value.getValue();
    form.content = content;

    if (page.for_edit){
        axios.put('/blogs/'+form.code,form).then((response)=>{
            console.log(response.data)
            if(response.data.success){
                alert.toast("Successfully updated blog");
                Object.assign(form, response.data.data);
                rteContent.value.setValue(response.data.data.content);
            }
        }).catch((error)=>{
            alert.error(error.response.data.message)
        })
    }else{
        axios.post('/blogs',form).then((response)=>{
          console.log(response.data)
            if(response.data.success){
                window.location.href = response.data.redirect;
            }
        }).catch((error)=>{
            alert.error(error.response.data.message)
        })
    }
}

onMounted(() => {
    if(props._blog){
        Object.assign(form, props._blog);
        rteContent.value.setValue(props._blog.content);
        page.for_edit = true;
    }
})
</script>

<template>
  <!-- Outer Row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="p-5">
        <div class="text-center">
          <h1 class="h4 text-gray-900 mb-4" v-if="page.for_edit">Edit Blog</h1>
          <h1 class="h4 text-gray-900 mb-4" v-else>Create a Blog!</h1>
        </div>
        <div class="container">
          <div class="form-group">
            <input
              type="text"
              class="form-control form-control-user"
              id="exampleName"
              placeholder="Title"
              v-model="form.title"
            />
          </div>
        </div>
        <RichTextEditor ref="rteContent" />
        
        <div class="container mt-3 text-right">
          <template v-if="page.for_edit">
            <div>
              <p class="mb-0">Created Date: {{ moment(form.created_at).format("MMM DD, YYYY hh:mm a") }}</p>
              <p class="mb-1">Last Update: {{ moment(form.updated_at).format("MMM DD, YYYY hh:mm a") }}</p>
            </div>
            <a class="btn btn-light btn-user mr-2" href="/blogs">
              Cancel
            </a>
            <button class="btn btn-primary btn-user" @click="saveBlog">
              Update Blog
            </button>
          </template>
          <template v-else>
            <button class="btn btn-primary btn-user"  @click="saveBlog">
              Save Blog
            </button>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>
