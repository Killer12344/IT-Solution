<template>
<nav aria-label="Page navigation example">
   <ul class="pagination">
      <li class="page-item" :class="{active:l.active}" v-for="(l,index) in links" :key="index">
         <Link class="page-link" :href="l.url" v-html="l.label"></Link>
      </li>
   </ul>
</nav>
</template>

<script>

import { Link } from "@inertiajs/inertia-vue"

export default {
   
   name : 'Pagination',
   props: { links:Array },
   components: { Link },
   
}
</script>

<style>

</style>