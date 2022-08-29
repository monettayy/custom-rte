<script setup>
import { reactive, getCurrentInstance } from 'vue';
const app = getCurrentInstance()
const alert = app.appContext.config.globalProperties.$alert;

const form = reactive({
    username:'',
    password:''
});

const login = () => {
    axios.post('/login', form).then((response)=>{
        if(response.data.success){
            window.location.href = response.data.data;
        }else{
            alert.error("Invalid Account!")
        }
    }).catch((error)=>{
      alert.error("Invalid Account!")
    })
}
</script>

<template>
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form @submit.prevent="login" class="user">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control form-control-user"
                      id="exampleInputEmail"
                      aria-describedby="emailHelp"
                      v-model="form.username"
                      placeholder="Username"
                    />
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control form-control-user"
                      v-model="form.password"
                      id="exampleInputPassword"
                      placeholder="Password"
                    />
                  </div>
                  <button
                    type="submit"
                    class="btn btn-primary btn-user btn-block"
                  >
                    Login
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
