require('./bootstrap');

require('alpinejs');
import Vue from 'vue';


Vue.component('example-component', require('./component/ExampleComponent').default)

const app = new Vue({
    el: '#app'
})