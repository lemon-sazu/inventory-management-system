import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

//Modules
import errors from './module/utils/errors/';
import categories from './module/categories';
import brands from './module/brands';
import sizes from './module/sizes';
import products from './module/products';
import stocks from './module/stocks';
import return_products from './module/return-product';

export default new Vuex.Store({
    modules: {
        errors,
        categories,
        brands,
        sizes,
        products,
        stocks,
        return_products
    }
})
