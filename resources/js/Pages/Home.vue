<template>
  <Master>
    <pagination :links="questions.links"></pagination>
    <div class="card mb-3" v-for="(q,index) in questions.data" :key="q.id">
      <div class="card-header bg-dark d-flex justify-content-between align-items-center">
        <div>
          <span v-if="q.is_fixed=='true'" class="badge badge-success mr-1"> Fixed </span>
          <span v-else class="badge badge-danger mr-1"> New Fixed </span>
          <span class="text-light font-weight-bold">{{ q.title }}</span>
        </div>
        <div>
          <!-- <a v-show="q.user_id == $page.props.auth.id" href=""> Hello </a> -->
          <a v-show="isOwn(q.user_id)" @click="setFixed(q.id,index)" href="#" class="badge badge-secondary" :class="{ 'd-none':q.is_fixed=='true' }">Fixed</a>
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
            <a @click="saveQuestion(q.id,index)" v-show="q.is_save=='false'" class="badge badge-light shadow-none mr-1 px-2 py-1">
              <i style="font-size:0.8rem;" class="bi bi-star text-warning"></i>
            </a>
            <a v-show="q.is_save!='false'" class="badge badge-light shadow-none mr-1 px-2 py-1">
              <i style="font-size:0.8rem;" class="text-warning bi bi-star-fill"></i>
            </a>
        </div>
        <div>
          <a :href="route('question.show',q.slug)" class="btn btn-dark rounded font-weight-bold btn-sm"> View </a>
        </div>
      </div>
    </div>
  </Master>
</template>
<script>
  import Master from './Layout/Master.vue';
  import axios from 'axios';
  import Pagination from './Components/Pagination.vue';
  export default {
    name: 'Home',
    data() {
      return {
        questions: this.$page.props.questions,
      }
    },
    components: {
      Master,
      Pagination
    },
    created() {
      if (this.$page.props.flash.success) {
          this.$toastr.s(this.$page.props.flash.success);
      }
    },
    methods: {
      like(q_id,index) {
        this.questions.data[index].is_like = 'true';
        this.questions.data[index].like_count++
        axios.get(`/like/${q_id}`);
      },
      isOwn(user_id){
        let current_id = this.$page.props.auth.id;

        if (user_id == current_id) {
            return true;
        }

      },
      setFixed(id,index){
        let data = new FormData();
        data.append('id',id);
        axios.post(route('question.fixed'),data).then((result) => {
          if (result.data.success) {

            this.questions.data[index].is_fixed = 'true';
            this.$toastr.s('Question is Fixed!');

          }
        });
      },
      isDelete(index,id){
            
            axios.get(route('question.delete',id)).then((result) => {

                if (result.data.success) {
                    this.questions.data.splice(index,1);
                    this.$toastr.s('Deleted is Success!');
                
                }
            });
          
      },
      saveQuestion(id,index){
          let data =new FormData();
          data.append('id',id);
          axios.post(route('question.save'),data).then((result) => {
              this.questions.data[index].is_save = 'true';
              if (result.data.success==true) {
                    this.$toastr.s('Save Question');
              }
          });
      }

    },
  };
</script>
<style></style>