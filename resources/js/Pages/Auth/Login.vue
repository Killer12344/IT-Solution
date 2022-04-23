<template>
      <div class="container">
         <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-12 col-md-5">
               <div class="card card-style">
                  <div class="card-body">
                     <h1 class="text-center p-3 font-weight-bolder word-style">SIGN IN</h1>
                     <form @submit.prevent="login">
                        <div class="form-group mb-4">
                           <input type="email" v-model="form.email" placeholder="Enter Email" name="email" id="email" 
                            :class="{ 'is-invalid errorBg' : errors.email }"                           
                            class="form-control form-input-style">
                            <div class="text-danger small"> {{ errors.password }} </div>
                        
                        </div>
                        <div class="form-group mb-4">
                           <input type="password" v-model="form.password" placeholder="Enter Password" name="password" id="password" 
                            :class="{ 'is-invalid errorBg' : errors.password }"                           
                            class="form-control form-input-style">
                            <div class="text-danger small"> {{ errors.password }} </div>
                        
                        </div>
                        <div class="form-group ml-1 form-check">
                           <input type="checkbox" class="form-check-input" id="exampleCheck1">
                           <label class="form-check-label text-black-50" for="exampleCheck1">Remember me</label>
                         </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary font-weight-bold rounded rounded-pill">Sign in</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
</template>

<script>
export default {
    name: "Login",
    props:['errors'],
    data() {
        return {
            form : {

             'email' : '',
             'password' : '',
        
        }
        }
    },
    methods: {
        login() {
            this.$inertia.post('/in',this.form);
        }
    },
}
</script>

