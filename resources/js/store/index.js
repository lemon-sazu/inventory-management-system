import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

//Modules
import errors from './module/utils/errors/';
import categories from './module/categories';
import brands from './module/brands';
import sizes from './module/sizes';
import products from './module/products';

export default new Vuex.Store({
    modules: {
        errors,
        categories,
        brands,
        sizes,
        products
    }
})
