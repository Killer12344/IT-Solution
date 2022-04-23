<template>
   <nav class="navbar py-4 navbar-expand-lg navbar-dark bg-info">
      <div class="container">
         <a class="navbar-brand" href="#">IT Solution</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/">All Question</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/?type=answer">Answered Question</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/?type=unanswer">Unanswered Question</a>
               </li>
            </ul>
         </div>
         <div class="navbar-collapse justify-content-end">
               <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                        <span>
                           <img :src="'../storage/images/profile/'+$page.props.auth.photo" class="rounded" width="30px" height="30px">
                        </span>
                        <span class="ml-1">
                        {{ $page.props.auth.name }} 
                        </span>
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="/profile/edit" class="dropdown-item">Edit Profile</a>
                        <a href="/logout" class="text-danger font-weight-bolder"> <i class="bi bi-arrow-return-right"></i> Logout </a>
                     </div>
                  </li>
               </ul>
         </div>
      </div>
   </nav>
</template>

<script>
export default {
   name : 'Nav'
}
</script>

<style>

</style>