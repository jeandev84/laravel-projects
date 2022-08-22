<template>
    <ul>
       <!-- Template will be show when user NOT AUTHENTICATED -->
          <li>
            <!--  {{ authenticated }} -->
            <!--  {{ user }} -->
            <router-link
                :to="{
                      name: 'home'
                   }"
            >
              Home
            </router-link>
          </li>
       <!-- / END NOT AUTHENTICATED -->

       <!-- Tempate will be show when user AUTHENTICATED -->
       <template v-if="authenticated">
         <li>
             {{ user.name }} ( {{ user.email}} )
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
           <a href="#" @click.prevent="signOut">
             Sign out
           </a>
         </li>
       </template>

       <!-- Login template -->
       <template v-else>
         <li>
           <router-link
               :to="{
                      name: 'signin'
                   }"
           >
             Sign In
           </router-link>
         </li>
       </template>
    </ul>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

  export default {
    name: "TheNavigationView",
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        })
    },
    methods: {
        ...mapActions({
             signOutAction: 'auth/signOut'
        }),

        signOut() {
            this.signOutAction()
                .then(() => {
                     // redirect to home page
                     this.$router.replace({
                         name: 'home'
                     });
                })
        }
    }
  }
</script>

<style scoped>

</style>