<template>
    <div class="container">

         <h1>Доски</h1>

        <!-- Add desk -->
        <form @submit.prevent="addNewDesk">
            <div class="form-group">
                <input type="text" v-model="name" class="form-control" :class="{ 'is-invalid': $v.name.$error }" placeholder="Введите название доски">

                <div class="invalid-feedback" v-if="!$v.name.required">
                    Обязательное поле.
                </div>
                <div class="invalid-feedback" v-if="!$v.name.maxLength">
                    Макс. количество символов: {{$v.name.$params.maxLength.max}} .
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Добавить</button>
        </form>


        <!-- Error message shower -->
        <div class="alert alert-danger mt-3" role="alert" v-if="errored">
             <div>Ошибка загрузки данных!</div>
             <div>{{ errors[0] }}</div>
        </div>


        <!-- Show  Desk List in one row -->
         <div class="row">
             <div class="col-lg-4" v-for="desk in desks">
                 <div class="card mt-3">
                     <router-link class="card-body" :to="{name: 'showDesk', params: {deskId: desk.id}}">
                         <h4 class="card-title">{{ desk.name }}</h4>
                     </router-link>
                     <button type="button" class="btn btn-danger mt-3" @click="deleteDesk(desk.id)">Удалить</button>
                 </div>
             </div>
         </div>

         <!-- Preloader -->
         <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status" v-if="loading">
            <span class="sr-only"></span>
         </div>
    </div>
</template>

<script>

import { required, maxLength } from 'vuelidate/lib/validators'


export default {
    // Initialize data
    data() {
        return {
            desks: [],
            errored: false,
            errors: [],
            loading: true,
            name: null
        }
    },
    // call API
    mounted() {

        this.getAllDesks();

    },
    methods: {

        getAllDesks() {

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
        },
        deleteDesk(id) {

            if(confirm('Вы действительно хотите удалить доску?')) {

                axios.post('/api/v1/desks/' + id, {
                    _method: 'DELETE'
                })
                .then(response => {

                    // Get response data
                    // console.log(response)
                    // console.log(response.data)

                    this.desks = []
                    this.getAllDesks()
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
        },
        addNewDesk() {

            // Заверщаем процесс в случае если возникла ошибка
            this.$v.$touch()

            if(this.$v.$anyError) {
                return;
            }

            axios.post('/api/v1/desks', {
                name: this.name,
            })
            .then(response => {

                // refresh data and stay in the same page
                this.name = ''
                this.desks = []
                this.getAllDesks()

            })
            .catch(error => {

                console.log(error)

                /*
                if(error.response.data.errors.name) {
                    this.errors = []
                    this.errors.push(error.response.data.errors.name[0])
                }
                */

                this.errored = true
            })
            .finally(() => {

                // Setting after then (success)

                setTimeout(() => {
                    this.loading = false
                }, 300)
            })

        }
    },
    validations: {
        name: {
            required,
            maxLength: maxLength(255)
        }
    }
}
</script>

<style scoped>

</style>
