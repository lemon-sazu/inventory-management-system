<template>
  <form method="POST" role="rorm" @submit.prevent="submitForm">
    <div class="row ml-4 mr-4">
      <div class="col-md-6">
        <ShowError></ShowError>
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Return Product</h5>
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="form-group">
                <label for="cat">
                  Product Name
                  <span class="text-danger">*</span>
                </label>

                <Select2
                  v-model="form.product_id"
                  :options="products"
                  id="products"
                  :settings="{ placeholder: 'Select Products' }"
                  :key="form.product_id"
                  @change="selectProcuct"
                ></Select2>
              </div>
              <div class="form-group">
                <label for="date"
                  >Date <span class="text-danger">*</span>
                </label>
                <input
                  v-model="form.date"
                  type="date"
                  class="form-control"
                  id="date"
                />
              </div>

              <div class="form-group">
                <button class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Product Sizes</h5>
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <tr v-for="(item, index) in form.items" :key="index">
                <td>
                  {{ item.size }}
                </td>
                <td>
                  <input
                    class="form-control"
                    v-model="item.quentity"
                    type="text"
                    placeholder="Quantity"
                  />
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import { mapGetters } from "vuex";
import store from "../../store";
import * as actions from "../../store/action-types";
import Select2 from "v-select2-component";
import ShowError from "./../utils/ShowError";
import products from "../../store/module/products";
export default {
  components: { Select2, ShowError },
  data() {
    return {
      form: {
        product_id: "",
        date: "",
        items: [],
      },
    };
  },
  computed: {
    ...mapGetters({
      products: "getProducts",
    }),
  },
  mounted() {
    store.dispatch(actions.GET_PRODUCTS);
  },
  methods: {
    selectProcuct(id) {
      this.form.items = [];
      let product = this.products.filter((product) => product.id == id);

      product[0].product_size_stock.map((stock) => {
        // console.log(stock);
        let item = {
          size: stock.size.size,
          size_id: stock.size_id,
          quentity: "",
        };
        this.form.items.push(item);
      });
    },
    submitForm() {
      store.dispatch(actions.SUBMIT_RETURN_PRODUCT, this.form);
    },
  },
};
</script>