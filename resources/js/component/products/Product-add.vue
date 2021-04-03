<template>
  <div>
    <div class="card">
      <div class="card-header">
        <h5 class="m-0">Create Product</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="">
          <div class="card-body">
            <div class="form-group">
              <label for="cat">Category Name</label>

              <Select2
                v-model="form.category_id"
                :options="categories"
                :settings="{ placeholder: 'Select Category' }"
                :key="form.category_id"
              ></Select2>
              <label class="mt-2" for="cat">Brand Name</label>
              <Select2
                v-model="form.brand_id"
                :options="brands"
                :settings="{ placeholder: 'Select Brand' }"
              ></Select2>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
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
      },
    };
  },
  computed: {
    ...mapGetters({
      categories: "getCategories",
      brands: "getBrands",
    }),
  },
  mounted() {
    // get categories
    store.dispatch(actions.GET_CATEGORIES);
    store.dispatch(actions.GET_BRANDS);
  },
};
</script>