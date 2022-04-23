<template>
   <master>
      <div class="card">
         <div class="card-body">
            <div class="alert alert-success" v-show="$page.props.flash.message">{{ $page.props.flash.message }}</div>
            <form @submit.prevent='update'>
               <div class="form-group mb-4">
                  <input type="text" v-model="form.name" class="form-control form-input-style" placeholder="Enter Name">
               </div>
               <div class="form-group mb-4">
                  <input type="email" v-model="form.email" class="form-control form-input-style" placeholder="Enter Email">
               </div>
               <div class="form-group mb-4">
                  <input type="password" v-model="form.password" class="form-control form-input-style" placeholder="Enter Password">
               </div>
               <img :src="'../storage/images/profile/'+$page.props.auth.photo" height="70px">
               <div class="form-group mb-4">
                  <label for="photo" class="text-black-50 ml-1"> Choose Photo </label>
                  <input type="file" id="photo" @change="selectImg" class="form-control p-1">
               </div>

               <div class="text-right">
                  <button class="btn btn-primary rounded rounded-pill"> Update </button>
               </div>
            </form>
         </div>
      </div>
   </master>
</template>

<script>

import Master from './Layout/Master.vue'

export default {

   name : 'EditUser',
   components : { Master },
   data() {
      return {
         form:{
            'name' : '',
            'email' : '',
            'password' : '',
            'photo' : '',
         }         
      }
   },
   created () {

      const {name,email} = this.$page.props.auth;
      this.form.name = name;
      this.form.email = email;
      
   },
   methods: {
      selectImg(e) {
         this.form.photo = e.target.files[0]
      },
      update(){
         this.$inertia.post(route('user.update'),this.form)
      }
   },

}
</script>

<style>

</style>