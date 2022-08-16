<template>
    <div class="container">
        <div class="form-group">
            <input type="text" @blur="saveName" v-model="name" class="form-control">
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
export default {
    props: [
        'deskId'
    ],
    data() {
        return {
            name: null, // desk name
            errored: false,
            loading: true
        }
    },
    methods: {

        saveName() {

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

    }
}
</script>

<style scoped>

</style>
