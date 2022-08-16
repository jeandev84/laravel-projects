<template>
    <div class="container">
        <div class="form-group">
            <input type="text" v-model="desk.name" class="form-control">
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
            desk: null
        }
    },
    mounted() {

        axios.get('/api/v1/desks/' + this.deskId)
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
