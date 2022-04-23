<template>
  <Master>
    <div class="card mb-3">
      <div class="card-header bg-dark d-flex justify-content-between align-items-center">
        <div>
          <span v-if="question.is_fixed=='true'" class="badge badge-success mr-1"> Fixed </span>
          <span v-else class="badge badge-danger mr-1"> New Fixed </span>
          <span class="text-light font-weight-bold"> {{ question.title }}</span>
        </div>
        <div v-show="isOwn(question.user_id)">
          <a @click="setFixed(question.id)" class="badge badge-secondary" :class="{ 'd-none':question.is_fixed=='true' }">Fixed</a>
          <a href="#" class="badge badge-danger">Delete</a>
        </div>
      </div>
      <div class="card-body">
        <div class="text-right mb-3">
          <span class="badge mx-1 badge-pill p-2 badge-dark" v-for="t in question.tag" :key="t.id">{{ t.name }}</span>
        </div>
        <p class="mb-5">
          {{ question.description }}
        </p>
        <hr class="mb-0">
        <div class="comment mb-3">
            <form @submit.prevent="createComment()">
              <div class="form-group">
                <textarea v-model="form.comment" class="form-control" placeholder="Enter Comment"></textarea>
              </div>
              <div class="text-right">
                <button class="btn btn-warning text-capitalize"> Comment </button>
              </div>
            </form>
        </div>
        <div class="border">
           <div class="border-bottom" style="background-color : #f5f6f6;" v-for="c in question.comment" :key="c.id" >
               <div class="d-flex p-3">
                  <img height="50px" class="rounded mt-1 rounded-circle" :src="'../storage/images/profile/'+c.user.photo" alt="">
                  <div class="d-inline-block ml-3 mt-2">
                     <div class="font-weight-bolder">{{ c.user.name }}</div>
                     <span class="small text-black-50">Comment {{ c.date }}</span>
                    <p class="my-4 text-black-50">
                      {{ c.comment }}
                    </p>
                  </div>
               </div>
           </div>

        </div>
      </div>
    </div>
  </Master>
</template>



<script>
  import Master from "./Layout/Master.vue"
  import axios from "axios"
  export default {
    name: "QuestionDetail",
    components: {
      Master
    },
    data() {
      return {
        question: this.$page.props.question,
        form : {
          q_id : this.$page.props.question.id,
          comment : '',
        }
      }
    },
    methods: {
      createComment() {
        axios.post('/comment',this.form).then((result) => {

          let { success,comment } = result.data;

          if (success) {
              this.question.comment.push(comment);
              this.form.comment = null;
              this.$toastr.s('Success Comment');
          }

        })
      },
      isOwn(user_id){
        let current_id = this.$page.props.auth.id;

        if (user_id == current_id) {
            return true;
        }

      },
      setFixed(id){
        let data = new FormData();
        data.append('id',id);
        axios.post(route('question.fixed'),data).then((result) => {
          if (result.data.success) {

            this.question.is_fixed = 'true';
            this.$toastr.s('Question is Fixed!');

          }
        });
      }
    },
  }
</script>
<style></style>