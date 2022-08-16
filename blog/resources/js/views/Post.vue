<template>
    <div>
        <spin v-if="loading"/>
        <div v-else-if="!loading && !not_found">
           <h1>{{ post.title }} <span class="uk-badge">{{ post.created_at }}</span></h1>
           <p class="uk-text-lead">
               {{ post.body }}
           </p>
        </div>
        <div class="uk-alert" v-if="not_found">
            <a class="uk-alert-close" uk-close></a>
            <h3>404 пост не найден</h3>
<!--     <p>Lorem ipsum dolor sit amet, consectetur.</p>  -->
        </div>
    </div>
</template>

<script>

import Spin from "../components/Spin";
import axios from "axios";


export default {
    components: {
       Spin
    },
    data: () => ({
        loading: true,
        post: [],
        not_found: false
    }),
    mounted() {

        // get parses params '/post/2'
        // console.log(this.$route.params.id)

        this.showPost(this.$route.params.id)
    },
    methods: {

        showPost(id) {

            axios.get('/api/posts/' + id)
                 .then(res => {
                     this.post = res.data;
                     setTimeout(() => {
                         this.loading = false;
                     }, 500);
                 })
                 .catch(err => {
                     this.not_found = true;
                 })
        }
    }
}
</script>

<style scoped>

</style>
