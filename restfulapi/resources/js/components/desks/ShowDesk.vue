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

        <!-- Add desk -->
        <form @submit.prevent="addNewDeskList" class="mt-3">
            <div class="form-group">
                <input type="text" v-model="desk_list_name" class="form-control" :class="{ 'is-invalid': $v.desk_list_name.$error }" placeholder="Введите название списка">

                <div class="invalid-feedback" v-if="!$v.desk_list_name.required">
                    Обязательное поле.
                </div>
                <div class="invalid-feedback" v-if="!$v.desk_list_name.maxLength">
                    Макс. количество символов: {{$v.desk_list_name.$params.maxLength.max}} .
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Добавить список</button>
        </form>


        <!-- Show  DeskList in one row -->
        <div class="row">
            <div class="col-lg-4" v-for="desk_list in desk_lists">
                <div class="card mt-3">
                    <div class="card-body">
                        <form @submit.prevent="updateDeskList(desk_list.id, desk_list.name)" v-if="desk_list_input_id == desk_list.id" class="d-flex justify-content-between align-items-center">
                            <input type="text" v-model="desk_list.name" class="form-control" placeholder="Введите название списка">
                            <button type="button" @click="desk_list_input_id = null" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                        <h4 v-else class="card-title d-flex justify-content-between align-items-center" style="cursor: pointer;" @click="desk_list_input_id = desk_list.id">
                            {{ desk_list.name }}
                            <i class="fas fa-pencil-alt" style="font-size: 15px; cursor: pointer;"></i>
                        </h4>
                        <button type="button" class="btn btn-danger mt-3" @click="deleteDeskList(desk_list.id)">Удалить список</button>
                        <div class="card mt-3 bg-light">
                            <div class="card-body">
                                <h4 class="card-title d-flex justify-content-between align-items-center" style="cursor: pointer;" @click="desk_list_input_id = desk_list.id">
                                    {{ desk_list.name }}
                                </h4>
                                <button type="button" class="btn btn-secondary mt-3">Удалить</button>
                            </div>
                        </div>
                        <form class="d-flex justify-content-between align-items-center mt-3">
                            <input type="text" class="form-control" placeholder="Введите название карточки">
                        </form>
                    </div>
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
            desk_list_name: null,
            errored: false,
            loading: true,
            desk_lists: true,
            desk_list_input_id: null
        }
    },
    methods: {

        updateDeskList(id, name) {

               axios.post('/api/v1/desk-lists/'+ id, {
                   _method: 'PUT',
                   name
               })
                .then(response => {
                    this.desk_list_input_id = null
                    // this.desk_lists = response.data.data
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
            this.$v.name.$touch()
            if(this.$v.name.$anyError) {
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

        },
        addNewDeskList() {

            // Заверщаем процесс в случае если возникла ошибка
            this.$v.$touch()

            if(this.$v.$anyError) {
                return;
            }

               axios.post('/api/v1/desk-lists', {
                  name: this.desk_list_name,
                  desk_id: this.deskId
               })
                .then(response => {

                    // refresh data and stay in the same page
                    this.desk_list_name = ''
                    this.desk_lists = []
                    this.getDeskLists()

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
        deleteDeskList(id) {

                axios.post('/api/v1/desk-lists/' + id, {
                   _method: 'DELETE'
                })
                .then(response => {

                    // Get response data
                    // console.log(response)
                    // console.log(response.data)

                    this.desk_lists = []
                    this.getDeskLists()
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
        },
        desk_list_name: {
            required,
            maxLength: maxLength(255)
        }
    }
}
</script>

<style scoped>

</style>
