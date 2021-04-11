import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';
import Axios from 'axios'

export default {
    [actions.ADD_PRODUCTS]({ commit }, payload) {
        Axios.post('/products', payload)
            .then(res => {
                if (res.data.success == true) {
                    window.location.href = '/products'
                    // console.log(res);
                }
            })
            .catch(err => {
                console.log(err.response.data)
                commit(mutations.SET_ERRORS, err.response.data.errors)
            })
    },
    [actions.EDIT_PRODUCTS]({ commit }, payload) {
        Axios.post(`/products/${payload.id}`, payload.data)
            .then(res => {
                if (res.data.success == true) {
                    window.location.href = '/products'
                    // console.log(res);
                }
            })
            .catch(err => {
                console.log(err.response.data)
                commit(mutations.SET_ERRORS, err.response.data.errors)
            })
    }
}