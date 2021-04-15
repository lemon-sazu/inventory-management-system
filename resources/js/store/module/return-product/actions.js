import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';
import Axios from 'axios'

export default {
    [actions.SUBMIT_RETURN_PRODUCT]({ commit }, payload) {
        Axios.post('/return_product', payload)
            .then(res => {
                if (res.data.success == true) {
                    window.location.href = '/return_products'
                }
            })
            .catch(err => {
                console.log(err.response.data)
                commit(mutations.SET_ERRORS, err.response.data.errors)
            })
    }

}