<template>
  <form @submit.prevent="save">
    <div class="card-body">
      <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" placeholder="Title" v-model="category.title">
        <form-errors :errors="errors.title"></form-errors>
      </div>
      <div class="form-group">
        <label>Parent category</label>
        <select class="form-control" v-model="category.parent_id">
          <option :value="0">-- Root --</option>
          <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
        </select>
        <form-errors :errors="errors.parent_id"></form-errors>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" placeholder="Description" v-model="category.description"></textarea>
        <form-errors :errors="errors.description"></form-errors>
      </div>
      <div class="form-group">
        <label>Meta Title</label>
        <input type="text" class="form-control" placeholder="Meta Title" v-model="category.meta_title">
        <form-errors :errors="errors.meta_title"></form-errors>
      </div>
      <div class="form-group">
        <label>Meta Description</label>
        <textarea class="form-control" placeholder="Meta Description" v-model="category.meta_description"></textarea>
        <form-errors :errors="errors.meta_description"></form-errors>
      </div>
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</template>

<script>
import axios from 'axios';

export default {
  name: "CategoryForm",
  props: {
    rootCategories: Array,
    propsCategory: Object,
    storeRoute: String,
    updateRoute: String,
    redirectRoute: String,
  },
  data() {
    return {
      category: this.propsCategory !== undefined ? this.propsCategory : {parent_id: 0},
      errors: {},
      categories: this.rootCategories ? this.rootCategories : [],
    }
  },
  methods: {
    save() {
      this.errors = {};
      if (this.storeRoute !== undefined) {
        axios.post(this.storeRoute, this.category).then(response => {
          this.showAlert('Created', 'Category created successfully');
        }).catch(error => {
          this.errors = error?.response?.data?.errors;
          this.showErrorAlert(error?.message);
        });
      } else {
        axios.post(this.updateRoute, {_method: 'put', ...this.category}).then(response => {
          this.showAlert('Updated', 'Category updated successfully');
        }).catch(error => {
          this.errors = error?.response?.data?.errors;
          this.showErrorAlert(error?.message);
        });
      }
    },
    showAlert(title, message) {
      this.$swal({
        title: title,
        text: message,
        type: "success",
        timer: 2000
      }).then(() => {
        window.location = this.redirectRoute;
      });
    },
    showErrorAlert(message) {
      this.$swal({
        title: "Error",
        text: message,
        type: "error"
      });
    }
  }
}
</script>
