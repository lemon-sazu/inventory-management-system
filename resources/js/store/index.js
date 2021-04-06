import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

//Modules
import categories from './module/categories';
import brands from './module/brands';
import sizes from './module/sizes';

export default new Vuex.Store({
    modules: {
        categories,
        brands,
        sizes
    }
})
