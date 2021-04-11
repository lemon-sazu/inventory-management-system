<template>
  <form method="POST" role="rorm" @submit.prevent="submitForm">
    <div class="row ml-4 mr-4">
      <div class="col-md-6">
        <ShowError></ShowError>
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
                  @change="selectImage"
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
              <button
                @click.prevent="addMoreSizes"
                class="btn btn-primary btn-sm mt-2"
              >
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
import ShowError from "./../utils/ShowError";
export default {
  components: { Select2, ShowError },
  data() {
    return {
      form: {
        category_id: "",
        brand_id: "",
        sku: "",
        name: "",
        image: "",
        cost_price: "",
        retail_price: "",
        year: "",
        description: "",
        status: 1,
        items: [
          {
            size_id: "",
            location: "",
            quantity: "",
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
    selectImage(e) {
      this.form.image = e.target.files[0];
    },
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
      let data = new FormData();
      data.append("category_id", this.form.category_id);
      data.append("brand_id", this.form.brand_id);
      data.append("sku", this.form.sku);
      data.append("name", this.form.name);
      data.append("image", this.form.image);
      data.append("cost_price", this.form.cost_price);
      data.append("retail_price", this.form.retail_price);
      data.append("year", this.form.year);
      data.append("description", this.form.description);
      data.append("status", this.form.status);
      data.append("items", JSON.stringify(this.form.items));

      store.dispatch(actions.ADD_PRODUCTS, data);
    },
  },
};
</script>