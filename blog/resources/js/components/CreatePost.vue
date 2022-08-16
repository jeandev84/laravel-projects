<template>
    <div>
        <form style="margin-bottom: 20px;">
            <fieldset class="uk-fieldset">
               <legend class="uk-legend">Опубликовать пост</legend>
               <div class="uk-margin">
                  <input type="text" v-model="form.title" class="uk-input" placeholder="Заговолок">
               </div>

               <div class="uk-margin">
                  <textarea class="uk-textarea" v-model="form.body" placeholder="Содержимое"></textarea>
               </div>
            </fieldset>

            <button class="uk-button uk-button-primary" @click.prevent="store">
                <div uk-spinner v-if="loading"></div>
                <span v-else>Опубликовать</span>
            </button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    components: {

    },
    data: () => ({
        form: {
            title: "",
            body: ""
        },
        loading: false,
    }),
    methods: {
        store() {
           axios.post('/api/posts', this.form, {
                headers: {
                    "Content-Type": "application/json"
                }
           })
           .then(res => {
               if (res.data.status) {
                   // redirect to the same page
                   this.$router.push('/post/' + res.data.post.id)
               }
           })
           .catch(err => {
               console.log(err.response.data)
           })
        }
    }
}
</script>

<style scoped>

</style>
