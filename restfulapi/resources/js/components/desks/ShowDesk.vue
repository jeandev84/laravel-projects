<template>
    <div class="container">

        <h1>{{ name }}</h1>

        <!-- Input form -->
        <div class="form-group">

            <input type="text" @blur="saveName" v-model="name" class="form-control" :class="{ 'is-invalid': $v.name.$error }">

            <!-- Message validation ( show next message if name empty ) -->
            <div class="invalid-feedback" v-if="!$v.name.required">
                Обязательное поле.
            </div>
            <div class="invalid-feedback" v-if="!$v.name.maxLength">
                Макс. количество символов: {{$v.name.$params.maxLength.max}} .
            </div>
        </div>

        <!-- Show  DeskList in one row -->
        <div class="row">
            <div class="col-lg-4" v-for="desk_list in desk_lists">
                <div class="card mt-3">
                    <a href="#" class="card-body">
                        <h4 class="card-title">{{ desk_list.name }}</h4>
                    </a>
                </div>
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
</template>

<script>

import { required, maxLength } from 'vuelidate/lib/validators'

export default {
    props: [
        'deskId'
    ],
    data() {
        return {
            name: null, // desk name
            errored: false,
            loading: true,
            desk_lists: true
        }
    },
    methods: {

        getDeskLists() {

            axios.get('/api/v1/desk-lists', {
               params: {
                   desk_id: this.deskId
               }
            })
            .then(response => {

                this.desk_lists = response.data.data
            })
            .catch(error => {
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
        saveName() {

            // Заверщаем процесс в случае если возникла ошибка
            this.$v.$touch()
            if(this.$v.$anyError) {
                return;
            }

            axios.post('/api/v1/desks/' + this.deskId, {
                _method: 'PUT',
                 name: this.name,
            })
            .then(response => {

            })
            .catch(error => {
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
    mounted() {

        // Show Desk
        axios.get('/api/v1/desks/' + this.deskId)
            .then(response => {

                // Get response data
                // console.log(response)
                // console.log(response.data)

                this.name = response.data.data.name
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


           // Show desks list
           this.getDeskLists();
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
