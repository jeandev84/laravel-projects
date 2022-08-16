<template>
    <div class="container">
         <h1>Доски</h1>
         <div class="row">

             <div class="col-lg-4" v-for="desk in desks">
                 <div class="card mt-3">
                     <a href="#" class="card-body">
                         <h5 class="card-title">{{ desk.name }}</h5>
                     </a>
                 </div>
             </div>
             <div class="alert alert-danger" role="alert" v-if="errored">
                  Ошибка загрузки данных!
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
            errored: false
        }
    },
    // call API
    mounted() {
         axios.get('/api/v1/desks')
              .then(response => {
                   // console.log(response)
                   // console.log(response.data)
                   this.desks = response.data.data
              })
             .catch(error => {
                  console.log(error)
                  this.errored = true
             })
    }
}
</script>

<style scoped>

</style>
