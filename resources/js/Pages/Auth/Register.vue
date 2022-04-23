<template>
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-12 col-md-5">
                <div class="card card-style">
                  <div class="card-body">
                    <h1 class="text-center p-3 font-weight-bolder word-style">SIGN UP</h1>
                    <form @submit.prevent="submit">
                        <div class="form-group mb-4">
                            <input type="text" id="name" placeholder="Enter Name" v-model="form.name" 
                            :class="{ 'is-invalid errorBg' : errors.name }"
                            class="form-control form-input-style"/>
                            <div class="text-danger small"> {{ errors.name }} </div>
                        </div>
                        <div class="form-group mb-4">
                            <input type="email" id="email" placeholder="Enter Email" v-model="form.email" 
                            :class="{ 'is-invalid errorBg' : errors.email }"
                            class="form-control form-input-style"/>
                            <div class="text-danger small"> {{ errors.email }} </div>
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" id="password" placeholder="Enter Password" v-model="form.password" 
                            :class="{ 'is-invalid errorBg' : errors.password }"
                            class="form-control form-input-style"/>
                            <div class="text-danger small"> {{ errors.password }} </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="custom-file">
                                <input type="file" @change="selectImage" 
                                :class="{ 'is-invalid errorBg' : errors.photo }"
                                class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                <label class="custom-file-label text-black-50" for="inputGroupFile04">Choose file</label>                            
                            </div>
                            <div class="text-danger d-inline-block small"> {{ errors.photo }} </div>
                        </div>

                        <div class="form-group form-check ml-1">
                           <input required type="checkbox" class="form-check-input" id="exampleCheck1">
                           <label class="form-check-label text-black-50" for="exampleCheck1">Remember me</label>
                         </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary font-weight-bold rounded rounded-pill">
                                <span>Sign Up</span>
                            </button>
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
    name: "Register",
    props:['errors'],
    data() {
        return {
            form : {
                name : null,
                email : null,
                password : null,
                photo : null,

            },
        }
    },
    methods: {
        selectImage(e) {
            this.form.photo = e.target.files[0]
        },
        submit(){
            this.form.load = true;
            this.$inertia.post('/up',this.form)

        }

    },
}
</script>
