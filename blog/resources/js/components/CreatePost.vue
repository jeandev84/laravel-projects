<template>
    <div>
        <div class="uk-alert-danger" uk-alert v-if="error">
            <a class="uk-alert-close" uk-close></a>
            <p>Проверьте правильность введенный полей</p>
        </div>
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
        error: false
    }),
    methods: {
        store() {

            this.loading = true;

            axios.post('/api/posts', this.form, {
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(res => {

               if (res.data.status) {
                   // redirect to the same page
                   this.$router.push('/post/' + res.data.post.id)
               } else {

                   setTimeout(() => {
                       this.loading = false;
                   }, 300);

                   this.error   = true;
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
