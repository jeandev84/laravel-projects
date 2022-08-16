<template>
    <div class="container">
         <h1>Доски</h1>
         <div class="row">
             <!-- Show  Desk List -->
             <div class="col-lg-4" v-for="desk in desks">
                 <div class="card mt-3">
                     <router-link class="card-body" :to="{name: 'showDesk', params: {deskId: desk.id}}">
                         <h4 class="card-title">{{ desk.name }}</h4>
                     </router-link>
                 </div>
             </div>

             <!-- Error message shower -->
             <div class="alert alert-danger" role="alert" v-if="errored">
                  Ошибка загрузки данных!
             </div>

             <!-- Preloader -->
             <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status" v-if="loading">
                 <span class="sr-only"></span>
             </div>

         </div>
    </div>
</template>

<script>
export default {
    // Initialize data
    data() {
        return {
            desks: [],
            errored: false,
            loading: true
        }
    },
    // call API
    mounted() {
         axios.get('/api/v1/desks')
              .then(response => {

                   // Get response data
                   // console.log(response)
                   // console.log(response.data)

                   this.desks = response.data.data
              })
             .catch(error => {

                  // Setting when we have error from server

                  console.log(error)
                  this.errored = true
             })
             .finally(() => {

                 // Setting after then (success)

                 setTimeout(() => {
                     this.loading = false
                 }, 300)
             })
    }
}
</script>

<style scoped>

</style>
