<script setup>
import { reactive, onMounted, defineProps  } from 'vue';

const props = defineProps({
    _user: {
        type: Object,
        default: null
    }
});

const form = reactive({
    name: '',
    username:'',
    password:'',
    repeat_password: '',
});

const saveUser = () => {
    if(form.password != form.repeat_password){
        return;
    }
    axios.post('/users',form).then((response)=>{
        if(response.data.success){
            window.location.href = response.data.redirect;
        }
    })
}

onMounted(() => {
    if(props._user){
      Object.assign(form, props._user);
    }
})
</script>

<template>
  <!-- Outer Row -->
  <div class="row">
    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
    <div class="col-lg-7">
      <div class="p-5">
        <div class="text-center">
          <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
        </div>
        <form class="user" @submit.prevent="saveUser">
          <div class="form-group">
            <input
              type="text"
              class="form-control form-control-user"
              id="exampleName"
              placeholder="Name"
              v-model="form.name"
            />
          </div>
          <div class="form-group">
            <input
              type="text"
              class="form-control form-control-user"
              id="exampleInputEmail"
              placeholder="Username"
              v-model="form.username"
            />
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <input
                type="password"
                class="form-control form-control-user"
                id="exampleInputPassword"
                placeholder="Password"
                v-model="form.password"
              />
            </div>
            <div class="col-sm-6">
              <input
                type="password"
                class="form-control form-control-user"
                id="exampleRepeatPassword"
                placeholder="Repeat Password"
                v-model="form.repeat_password"
              />
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-user btn-block">
            Register Account
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
