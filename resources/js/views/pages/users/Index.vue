<script setup>
import { reactive, onMounted, getCurrentInstance } from 'vue';
const app = getCurrentInstance()
const alert = app.appContext.config.globalProperties.$alert;

const page = reactive({
    title: 'User',
    list_title: 'Users',
    create_url:'/users/create',
    data_list: [],
});

const getUsers = () => {
    axios.get('/users-list').then((response)=>{
        if(response.data.success){
            page.data_list = response.data.data;
        }
    })
}

const editItem = () => {
    window.location.href = response.data.redirect;
}

const deleteItem = () => {
    axios.get('/users-list').then((response)=>{
        if(response.data.success){
            page.data_list = response.data.data;
        }
    })
}

onMounted(() => {
    alert.toast("Welcome!");
    getUsers();
})
</script>

<template>
  <div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">List</h1>
    <p class="mb-4">
      This page includes list of all {{ page.list_title }}. 
      To create a new one go to
      <a target="_blank" :href="page.create_url">{{ page.title }} Create Page
      </a>.
    </p>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          {{ page.list_title }} Table
        </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            class="table table-bordered"
            id="dataTable"
            width="100%"
            cellspacing="0"
          >
            <thead>
              <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Created Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Created Date</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody v-if="page.data_list && page.data_list.length > 0">
              <tr v-for="(data, i) in page.data_list">
                <td>{{ data.name }}</td>
                <td>{{ data.username }}</td>
                <td>{{ data.created_at }}</td>
                <td>
                  <a
                    class="btn btn-primary btn-icon-split btn-sm ma-1"
                    :href="'/users/'+data.id"
                  >
                    <span class="icon text-white-50">
                      <i class="fas fa-pen"></i>
                    </span>
                    <span class="text">Edit</span>
                  </a>
                  <button
                    class="btn btn-danger btn-icon-split btn-sm ma-1"
                    @click="deleteItem"
                  >
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Delete</span>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
