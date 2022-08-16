<template>
    <div class="container">
        <div class="form-group">
            <input type="text" v-model="name" class="form-control">
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
