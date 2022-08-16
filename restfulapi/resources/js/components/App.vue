<template>
   <div class="container">
       <p>
           <router-link :to="{name: 'home'}">Home</router-link>
           <router-link :to="{name: 'about'}">About</router-link>
       </p>
       <div>
           <router-view></router-view>
       </div>
   </div>
</template>

<script>
export default {
    // name: "App"
}
</script>

<style scoped>

</style>
