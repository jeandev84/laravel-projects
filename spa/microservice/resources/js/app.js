require('./bootstrap');
window.Vue = require('vue').default;
import { Form, HasError, AlertError } from 'vform';


// Vue.component(HasError.name, HasError);
// Vue.component(AlertError.name, HasError);
// Vue.component('pagination', require('laravel-vue-pagination').default);
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('product-component', require('./components/ProductComponent.vue').default);


window.Form = Form;


const app = new Vue({
    el: '#app',
});
