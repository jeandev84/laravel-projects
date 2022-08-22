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

// import axios from 'axios'

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
     async submit() {

         // console.log('submitted');

         // let response = axios.post('http://127.0.0.1:8000/api/auth/signin', this.form)

         // console.log((await response).data);
     }
  }
}
</script>
