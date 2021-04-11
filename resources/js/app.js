require('./bootstrap');

require('alpinejs');
import Vue from 'vue';


Vue.component('example-component', require('./component/ExampleComponent').default)
Vue.component('product-add', require('./component/products/Product-add').default)
Vue.component('product-edit', require('./component/products/Product-edit').default)

import store from './store';

const app = new Vue({
    el: '#app',
    store
})