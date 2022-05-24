<template>
  <div class="category">
    <i class="nav-icon fas fa-bars bars-draggable"></i>
    {{ category.title }}
    <div class="btn-group float-right">
      <a :href="editLink" class="btn btn-xs btn-warning">Edit</a>
      <button class="btn btn-xs btn-danger" @click="deleteCategory">Delete</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "CategoryInline",
  props: {
    category: Object,
    editRoute: String,
    deleteRoute: String,
  },
  computed: {
    editLink() {
      return this.editRoute.replace('CATEGORY', this.category.id);
    },
    deleteLink() {
      return this.deleteRoute.replace('CATEGORY', this.category.id);
    },
  },
  methods: {
    deleteCategory() {
      this.$swal.fire({
        title: "Do you really want to delete this category?",
        text: '',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post(this.deleteLink, {_method: 'delete'}).then(result => {
            this.$swal.fire('Deleted', '', 'success');
            this.$emit('deleted-row', {...result, row_key: this.category.id});
          }).catch(error => {
            this.$swal.fire('Error', error?.message, 'error');
            this.$emit('deleting-error', error);
          });
        }
      });
    }
  }
}
</script>

<style scoped>
.category {
  padding: 5px;
  background: #e2e2e2;
  margin: 5px auto;
  border-radius: 5px;
}
.bars-draggable {
  margin-left: 5px;
  margin-right: 10px;
  cursor: grab;
}
</style>
