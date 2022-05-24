<template>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Published at</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(article, index) in articles">
        <td>{{ article.id }}</td>
        <td>{{ article.title }}</td>
        <td>{{ article.category.title }}</td>
        <td>{{ article.is_active ? 'active' : 'disabled' }}</td>
        <td>{{ article.published_at.replace('T', ' ') }}</td>
        <td>
          <button @click="editArticle(article.id)" class="btn btn-sm btn-warning">Edit</button>
          <button class="btn btn-sm btn-danger" @click="deleteArticle(article.id, index)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";

export default {
  name: "ArticlesList",
  props: {
    propsArticles: Array,
    editRoute: String,
    deleteRoute: String,
  },
  data() {
    return {
      articles: this.propsArticles ? this.propsArticles : [],
    }
  },
  methods: {
    editArticle (id) {
      window.location.href = this.editRoute.replace('ARTICLE', id);
    },
    deleteLink (id) {
      return this.deleteRoute.replace('ARTICLE', id);
    },
    deleteArticle (id, index) {
      this.$swal.fire({
        title: "Do you really want to delete this article?",
        text: '',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post(this.deleteLink(id), {_method: 'delete'}).then(result => {
            this.$swal.fire('Deleted', '', 'success');
            this.$delete(this.articles, index);
          }).catch(error => {
            this.$swal.fire('Error', error?.message, 'error');
          });
        }
      });
    },
  }
}
</script>
