<template>
   <master>
      <ul class="list-group">
         <li class="list-group-item" v-for="q in saveQ" :key="q.id">
            <a :href="route('question.show',q.question.slug)">
               {{ q.question.title }}
            </a>
         </li>
      </ul>
   </master>
</template>

<script>
import Master from "./Layout/Master.vue"

export default {
  components: { Master },
   data() {
      return {
         saveQ : this.$page.props.saveQ
      }
   },
}
</script>

<style>

</style>