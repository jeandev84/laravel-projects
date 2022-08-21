require('./bootstrap');
window.Vue = require('vue').default;


Vue.component('product-component', require('./components/ProductComponent.vue').default);


const app = new Vue({
    el: '#app',
});
