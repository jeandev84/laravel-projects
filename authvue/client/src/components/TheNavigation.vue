<template>
    <ul>
       <li>
           <router-link
               :to="{
                  name: 'home'
               }"
           >
             Home
           </router-link>
       </li>
      <li>
        <router-link
            :to="{
                  name: 'signin'
               }"
        >
          Sign In
        </router-link>
      </li>
       <li>
        <router-link
            :to="{
                  name: 'dashboard'
               }"
        >
          Dashboard
        </router-link>
      </li>
      <li>
         Yao Kouassi Jean-Claude
      </li>
      <li>
        <a href="#">
          Sign out
        </a>
      </li>
    </ul>
</template>

<script>
export default {
  name: "TheNavigationView"
}
</script>

<style scoped>

</style>