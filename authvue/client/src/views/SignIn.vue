<template>
  <form @submit.prevent="submit">
<!--  {{ form }}-->
      <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" v-model="form.email">
      </div>

      <div>
       <label for="password">Password</label>
       <input type="password" name="password" id="password" v-model="form.password">
      </div>

       <div>
         <button type="submit">Sign In</button>
       </div>
  </form>
</template>

<script>

import { mapActions } from 'vuex';



export default {
  name: 'SignInView',
  data() {
     return {
         form: {
            email: '',
            password: ''
         }
     }
  },
  components: {

  },
  methods: {
       /*
        async submit() {

           // console.log('submitted');

           let response = axios.post('/auth/signin', this.form)

           console.log((await response).data);
       }
      */

      ...mapActions({
          signIn: 'auth/signIn'
      }),
      submit() {
         // Sign In User (Login)
         this.signIn(this.form)
             .then(() => {

                 // redirect to dashboard page
                 this.$router.replace({
                      name: 'dashboard'
                 });
             })

         // Redirect User to Dashboard page
      }
  }
}
</script>
