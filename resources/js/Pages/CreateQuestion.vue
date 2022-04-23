<template>
   <master>
      <div class="card">
         <div class="card-body">
            <form @submit.prevent="create">
               <div class="form-group">
                  <input type="text" class="form-control"
                   :class="{ 'is-invalid' : errors.title }"
                   v-model="form.title" placeholder="Enter Question Title">
                  <div class="text-danger small">{{ errors.title }}</div>            
               </div>
               <div class="form-group ml-1">
                  <div class="form-check mb-2" v-for="t in $page.props.allTags" :key="t.id">
                     <input class="form-check-input"
                      :class="{ 'is-invalid' : errors.tag }"
                      @change="selectTag" type="checkbox" :id="t.id" :value="t.id">
                     <label class="form-check-label" :for="t.id">
                        {{ t.name }}
                     </label>
                  </div>
                  <div class="text-danger small">{{ errors.tag }}</div>            
               </div>
               <div class="form-group">
                  <textarea v-model="form.description" class="form-control"
                   :class="{ 'is-invalid' : errors.description }"
                   placeholder="Enter Question" id="" cols="30" rows="10"></textarea>
                  <div class="text-danger small"> {{ errors.description }} </div>
               </div>
               <button class="btn btn-primary"> Ask Question </button>
            </form>
         </div>
      </div>
   </master>
</template>

<script>
import Master from './Layout/Master.vue'
export default {
  components: { Master },
  props: ['errors'],
  data() {
     return {
        form:{
           title : '',
           description : '',
           tag : [],
        }
     }
  },

  created () {
      
  },

  methods: {
     create() {
         this.$inertia.post(route('question.store'),this.form);
         console.log(this.form);
   },
     selectTag(e){
         
      if (this.form.tag.includes(e.target.value)) {
         
         this.form.tag.splice(1,1);
         console.log(this.form.tag);

      }else{

         this.form.tag.push(e.target.value);
         console.log(this.form.tag);
      
      }

   }
  },

}
</script>

<style>

</style>