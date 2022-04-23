<template>
  <section>
   <!-- Navbar_start -->
      <Nav></Nav>
   <!-- Navbar_end -->

   <!-- Content_start -->
      <div class="container">
         <div class="row mt-3">
            <!-- left -->
            <sidebar></sidebar>

            <!-- right -->
            <div class="col-12 col-md-8">
               <slot></slot>
            </div>

         </div>
      </div>
   <!-- Content_end -->
  </section>
</template>

<script>
import Nav from './Nav.vue'
import Sidebar from './Sidebar.vue'
   export default {
   components: { Nav, Sidebar },
      name : 'Master',

   }
</script>

<style lang="scss" scoped>

</style>