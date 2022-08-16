<template>
     <div>
         <spin v-if="loading"></spin>
         <div style="display:flex; flex-wrap: wrap;" v-else>
             <div class="uk-card uk-card-default uk-width-1-2@m" v-for="post in posts">
                 <div class="uk-card-header">
                     <div class="uk-grid-small uk-flex-middle" uk-grid>
                         <div class="uk-width-auto">
                             <!-- <img class="uk-border-circle" width="40" height="40" src="images/avatar.jpg">-->
                         </div>
                         <div class="uk-width-expand">
                             <h3 class="uk-card-title uk-margin-remove-bottom">{{ post.title }}</h3>
                             <p class="uk-text-meta uk-margin-remove-top">
                                 <time datetime="2016-04-01T19:00">{{ post.created_at }}</time>
                             </p>
                         </div>
                     </div>
                 </div>
                 <div class="uk-card-body">
                     <p>{{ post.body }}</p>
                 </div>
                 <div class="uk-card-footer">
                     <a href="#" class="uk-button uk-button-text">Read more</a>
                 </div>
            </div>
       </div>
     </div>
</template>

<script>

import Spin from '../components/Spin';
import axios from 'axios';



export default {
    components: {
        Spin
    },
    data: () => ({
        // Initialize all data we want to use
        loading: true,
        posts: []
    }),
    mounted() {
       // call methods defined inside methods: { }
       this.loadPosts()
    },
    methods: {

        loadPosts() {

            axios.get('/api/posts')
                .then(res => {

                     // console.log(res.data)
                     // получаем наши посты
                     this.posts = res.data;

                     // stop loading after 0.5s
                     setTimeout(() => {
                         this.loading = false;
                     }, 500)
                 })
        }
    }
}
</script>

<style scoped>
    .uk-card {
        width: 40%;
        margin-right: 20px;
        margin-bottom: 20px;
    }
    .uk-card:last-child {
        margin-right: 0;
    }
</style>
