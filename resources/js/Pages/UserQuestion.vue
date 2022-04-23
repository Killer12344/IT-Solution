<template>
   <master>
     <pagination :links="user_question.links"></pagination>
    <div class="card mb-3" v-for="(q,index) in user_question.data" :key="q.id">
      <div class="card-header bg-dark d-flex justify-content-between align-items-center">
        <div>
          <span class="badge badge-danger mr-1"> New Fiexd </span>
          <span class="text-light font-weight-bold">{{ q.title }}</span>
        </div>
        <div>
          <!-- <a v-show="q.user_id == $page.props.auth.id" href=""> Hello </a> -->
          <a v-show="isOwn(q.user_id)" class="badge badge-secondary">Fixed</a>
          <a v-show="isOwn(q.user_id)" @click="isDelete(index,q.id)" class="badge badge-danger">Delete</a>
        </div>
      </div>
      <div class="card-body">
        <div class="text-right mb-3">
          <span class="badge badge-pill m-1 p-2 badge-dark" v-for="tag in q.tag" :key="tag.id"> {{ tag.name }} </span>
        </div>
        <p class="mb-0">
          {{ q.description }}
        </p>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center" style="background:none">
        <div>
          <a class="badge badge-light shadow-none mr-1 px-2 py-1" @click="like(q.id,index)" v-show="q.is_like!='true'">
            <i style="font-size:0.8rem;" class="bi bi-heart text-danger"></i> {{ q.like_count }}
          </a>
          <a class="badge badge-light shadow-none mr-1 px-2 py-1" v-show="q.is_like=='true'">
            <i style="font-size:0.8rem;" class="bi bi-heart-fill text-danger"></i> {{ q.like_count }}
          </a>
          <a class="badge badge-light shadow-none mr-1 px-2 py-1">
            <i style="font-size:0.8rem;" class="bi bi-chat-square text-success"></i> {{ q.comment.length }} </a>
          <a class="badge badge-light shadow-none mr-1 px-2 py-1">
            <i style="font-size:0.8rem;" class="bi bi-star text-warning"></i> {{ q.save_question.length }} </a>
        </div>
        <div>
          <a :href="route('question.show',q.slug)" class="btn btn-dark rounded font-weight-bold btn-sm"> View </a>
        </div>
      </div>
    </div>
   </master>
</template>

<script>
   import Master from './Layout/Master.vue'
   import axios from 'axios'
   import Pagination from './Components/Pagination.vue'
   export default {
      name : 'UserQuestion',
      components: { Master, Pagination },
      data() {
         return {
            user_question: this.$page.props.user_question,
         }
      },
      methods: {
         like(q_id,index) {
            this.user_question.data[index].is_like = 'true';
            this.user_question.data[index].like_count++
            axios.get(`/like/${q_id}`);
         },
         
         isOwn(user_id){
         let current_id = this.$page.props.auth.id;

         if (user_id == current_id) {
               return true;
         }

         },
         isDelete(index,id){
            axios.get(route('question.delete',id)).then((result) => {

                if (result.data.success) {
                    this.user_question.data.splice(index,1);
                    this.$toastr.s('Deleted is Success!');
                
                }
            });
          
         }
      },
      
   }
</script>

<style lang="scss" scoped>

</style>