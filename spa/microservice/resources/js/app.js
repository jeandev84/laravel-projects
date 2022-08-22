require('./bootstrap');
window.Vue = require('vue').default;
import { Form, HasError, AlertError } from 'vform';
import Swal from 'sweetalert2';
import VueProgressBar from 'vue-progressbar';
import Loading from 'vue-loading-overlay';


// Loading
Vue.use(Loading, {
    color: '#3490dc',
    width: '45px',
    height: '45px'
});


// Progress Bar
Vue.use(VueProgressBar, {
    color: '#3490dc',
    failedColor: 'red',
    thickness: '5px'
});


// Register component globally
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, HasError);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('product-component', require('./components/ProductComponent.vue').default);


window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end', // bottom-end (show message to the bottom)
    showConfirmButton: false,
    timer: 3000, // 1000s ... can be changed
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
})


window.Form = Form;
window.Swal = Swal;


const app = new Vue({
    el: '#app',
});
