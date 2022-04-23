<template>
   <div class="col-12 col-md-4">
      <div v-show='!isUrl'>
         <a :href="route('question.create')" class="list-group-item text-white m-0 bg-primary font-weight-bold">Ask Question</a>

         <div class="list-group">
            <h5 class="list-group-item m-0 font-weight-bold"> All Tags</h5>
            <a :href="'/?tag='+t.slug" v-for="t in $page.props.allTags" :key="t.id" class="list-group-item list-group-item-action">
               {{ t.name }}
            </a>
         </div>
             <!-- <div v-for="item in $page.props.questions" :key="item.id">
                  {{ item.tag.length }}
            </div> -->

      </div>


      <div v-show='isUrl'>
         <div class="list-group">
            <Link :href="route('question.create')" class="list-group-item text-white m-0 bg-primary font-weight-bold">Ask Question</Link>
            <Link :href="route('user.edit')" class="list-group-item list-group-item-action">
              <i class="bi bi-person-fill"></i> Edit Profile
            </Link>
            <Link :href="route('question.user')" class="list-group-item list-group-item-action">
               <i class="bi bi-question-circle-fill"></i> Your Question
            </Link>
            <Link :href="route('question.save')" class="list-group-item list-group-item-action">
               <i class="bi bi-star"></i> Your Save Question
            </Link>
         </div>
      </div>
   </div>
</template>

<script>

import { Link } from "@inertiajs/inertia-vue";

export default {
   name : "Sidebar",
   components: {
      Link,
   },
   computed: {
      isUrl() {
         let url = location.pathname;
         let exp = '/profile/.*';
         let res = url.match(exp);

         if (res) {
            return true;
         }
         return false;
      }
   },
}
</script>

<style>

</style>