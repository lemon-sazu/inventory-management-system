<template>
  <form method="POST" role="rorm" @submit.prevent="submitForm">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Create Product</h5>
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="form-group">
                <label for="cat">
                  Category Name
                  <span class="text-danger">*</span>
                </label>

                <Select2
                  v-model="form.category_id"
                  :options="categories"
                  name="category"
                  id="category"
                  :settings="{ placeholder: 'Select Category' }"
                  :key="form.category_id"
                ></Select2>

                <label class="mt-2" for="cat"
                  >Brand Name <span class="text-danger">*</span>
                </label>
                <Select2
                  v-model="form.brand_id"
                  :options="brands"
                  :settings="{ placeholder: 'Select Brand' }"
                ></Select2>
              </div>
              <div class="form-group">
                <label for="sku">SKU <span class="text-danger">*</span></label>
                <input
                  type="text"
                  v-model="form.sku"
                  class="form-control"
                  id="sku"
                  placeholder="SKU"
                />
              </div>
              <div class="form-group">
                <label for="name"
                  >Name <span class="text-danger">*</span></label
                >
                <input
                  type="text"
                  v-model="form.name"
                  class="form-control"
                  id="name"
                  placeholder="Product Name"
                />
              </div>
              <div class="form-group">
                <label for="image"
                  >Image <span class="text-danger">*</span>
                </label>
                <input
                  type="file"
                  class="form-control"
                  placeholder="Image"
                  id="image"
                />
              </div>
              <div class="form-group">
                <label for="cost_price"
                  >Cost Price <span class="text-danger">*</span>
                </label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.cost_price"
                  id="cost_price"
                  placeholder="Cost Price"
                />
              </div>
              <div class="form-group">
                <label for="retail_price"
                  >Retail Price <span class="text-danger">*</span>
                </label>
                <input
                  type="text"
                  v-model="form.retail_price"
                  class="form-control"
                  id="retail_price"
                  placeholder="Retail Price"
                />
              </div>
              <div class="form-group">
                <label for="year"
                  >Year <span class="text-danger">*</span></label
                >
                <input
                  type="text"
                  v-model="form.year"
                  class="form-control"
                  placeholder="(EX: 2021)"
                  id="year"
                />
              </div>
              <div class="form-group">
                <label for="description"
                  >Description <span class="text-danger">*</span>
                </label>
                <input
                  type="text"
                  v-model="form.description"
                  class="form-control"
                  id="description"
                  placeholder="Product Description [MAX:200]"
                />
              </div>
              <div class="form-group">
                <label for="status"
                  >Status <span class="text-danger">*</span>
                </label>
                <select id="status" v-model="form.status" class="form-control">
                  <option value="0">Inactive</option>
                  <option value="1">Active</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
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
            <div
              class="row mb-2"
              v-for="(item, index) in form.items"
              :key="index"
            >
              <div class="col-md-4">
                <select class="form-control" v-model="item.size_id">
                  <option value="">Select Sizes</option>
                  <option
                    v-for="(size, index) in sizes"
                    :key="index"
                    :value="size.id"
                  >
                    {{ size.size }}
                  </option>
                </select>
              </div>
              <div class="col-md-3">
                <input
                  type="text"
                  class="form-control"
                  v-model="item.location"
                  placeholder="Location"
                />
              </div>
              <div class="col-md-3">
                <input
                  type="text"
                  v-model="item.quantity"
                  class="form-control"
                  placeholder="Quantity"
                />
              </div>
              <div class="col-md-2">
                <button
                  @click="deleteSizes(index)"
                  class="btn btn-danger btn-sm"
                >
                  <i class="fa fa-trash"></i>
                </button>
              </div>
            </div>
            <div class="add_button">
              <button @click="addMoreSizes" class="btn btn-primary btn-sm mt-2">
                <i class="fa fa-plus"></i> Add More
              </button>
            </div>
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
export default {
  components: { Select2 },
  data() {
    return {
      form: {
        category_id: 0,
        brand_id: 0,
        sku: "",
        name: "",
        image: "",
        cost_price: 0,
        retail_price: 0,
        year: "",
        description: "",
        status: 1,
        items: [
          {
            size_id: "",
            location: "",
            quantity: 0,
          },
        ],
      },
    };
  },
  computed: {
    ...mapGetters({
      categories: "getCategories",
      brands: "getBrands",
      sizes: "getSizes",
    }),
  },
  mounted() {
    // get categories
    store.dispatch(actions.GET_CATEGORIES);
    store.dispatch(actions.GET_BRANDS);
    store.dispatch(actions.GET_SIZES);
  },
  methods: {
    addMoreSizes() {
      let item = {
        size_id: "",
        location: "",
        quantity: 0,
      };
      this.form.items.push(item);
    },
    deleteSizes(index) {
      this.form.items.splice(index);
    },
    submitForm() {
      console.log(this.form);
    },
  },
};
</script>