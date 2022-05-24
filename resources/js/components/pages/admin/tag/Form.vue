<template>
  <form @submit.prevent="save">
    <div class="card-body">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" placeholder="Name" v-model="tag.name">
        <form-errors :errors="errors.name"></form-errors>
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
  name: "TagForm",
  props: {
    propsTag: Object,
    storeRoute: String,
    updateRoute: String,
    redirectRoute: String,
  },
  data() {
    return {
      tag: this.propsTag !== undefined ? this.propsTag : {},
      errors: {},
    }
  },
  methods: {
    save() {
      this.errors = {};
      if (this.storeRoute !== undefined) {
        axios.post(this.storeRoute, this.tag).then(response => {
          this.showAlert('Created', 'Tag created successfully');
        }).catch(error => {
          this.errors = error?.response?.data?.errors;
          this.showErrorAlert(error?.message);
        });
      } else {
        axios.post(this.updateRoute, {_method: 'put', ...this.tag}).then(response => {
          this.showAlert('Updated', 'Tag updated successfully');
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
