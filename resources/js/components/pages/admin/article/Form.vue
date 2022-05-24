<template>
  <form @submit.prevent="save">
    <div class="card-body">
      <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" placeholder="Title" v-model="article.title">
        <form-errors :errors="errors.title"></form-errors>
      </div>
      <div class="form-group">
        <label>Category</label>
        <select class="form-control" v-model="article.category_id">
          <option :value="0" disabled>-- Choose category --</option>
          <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
        </select>
        <form-errors :errors="errors.category_id"></form-errors>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" v-model="article.description"></textarea>
        <form-errors :errors="errors.description"></form-errors>
      </div>
      <div class="form-group">
        <label>Content</label>
        <tinymce class="form-control" v-model="article.content"></tinymce>
        <form-errors :errors="errors.content"></form-errors>
      </div>
      <div class="form-group">
        <label>Is active</label>
        <input type="checkbox" v-model="article.is_active">
      </div>
      <div class="form-group">
        <label>Published at</label>
        <input type="datetime-local" class="form-control" v-model="article.published_at">
        <form-errors :errors="errors.published_at"></form-errors>
      </div>
      <tags-input
        :props-tags="availableTags"
        v-model="article.tags"
      >
      </tags-input>
      <div class="form-group">
        <label>Meta Title</label>
        <input type="text" class="form-control" placeholder="Meta Title" v-model="article.meta_title">
        <form-errors :errors="errors.meta_title"></form-errors>
      </div>
      <div class="form-group">
        <label>Meta Description</label>
        <textarea class="form-control" v-model="article.meta_description"></textarea>
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
  name: "ArticleForm",
  props: {
    propsCategories: Array,
    propsArticle: Object,
    availableTags: Array,
    storeRoute: String,
    updateRoute: String,
    redirectRoute: String,
  },
  data() {
    return {
      article: this.propsArticle !== undefined ? this.propsArticle : {category_id: 0, tags: []},
      errors: {},
      categories: this.propsCategories ? this.propsCategories : [],
    }
  },
  methods: {
    save() {
      this.errors = {};
      if (this.storeRoute !== undefined) {
        axios.post(this.storeRoute, this.article).then(response => {
          this.showAlert('Created', 'Article created successfully');
        }).catch(error => {
          this.errors = error?.response?.data?.errors;
          this.showErrorAlert(error?.message);
        });
      } else {
        axios.post(this.updateRoute, {_method: 'put', ...this.article}).then(response => {
          this.showAlert('Updated', 'Article updated successfully');
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
